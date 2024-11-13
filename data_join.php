<?php
session_start();
// Pastikan pengguna sudah login sebagai admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$host = "localhost";
$dbname = "galeri_db"; // Ganti dengan nama database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data band_members_new
$sql = "SELECT * FROM band_members_new";
$result = $conn->query($sql);

// Ambil statistik bakat
$sql_statistik = "SELECT talent, COUNT(*) as total FROM band_members_new GROUP BY talent";
$result_statistik = $conn->query($sql_statistik);

$talent_labels = [];
$talent_data = [];
while ($row_statistik = $result_statistik->fetch_assoc()) {
    $talent_labels[] = $row_statistik['talent'];
    $talent_data[] = $row_statistik['total'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Permintaan Join Band</title>
    <style>
        /* Gaya CSS untuk halaman */
        body {
            display: flex;
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f9;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
            flex: 1;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        img {
            width: 100px;
        }
        canvas {
            max-width: 600px;
            margin: 20px 0;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include 'navbar.php'; // Menyertakan navbar ?>

<div class="content">
    <h1>Kelola Permintaan Join Band</h1>
    <table>
        <tr>
            <th>Nama</th>
            <th>Usia</th>
            <th>Bakat</th>
            <th>Email</th>
            <th>Foto</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['age']); ?></td>
                <td><?php echo htmlspecialchars($row['talent']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><img src="<?php echo htmlspecialchars($row['photo_path']); ?>" alt="Foto"></td>
            </tr>
        <?php endwhile; ?>
    </table>
   </div>
</body>
</html>
