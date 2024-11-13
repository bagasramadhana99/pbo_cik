<?php
session_start();
// Pastikan pengguna sudah login sebagai admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "galeri_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menyimpan data jadwal konser jika form dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $waktu = $_POST['waktu'];

    $sql = "INSERT INTO jadwal_konser (tanggal, lokasi, waktu) VALUES ('$tanggal', '$lokasi', '$waktu')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Jadwal konser berhasil ditambahkan.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Konser</title>
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .content {
            margin-left: 220px; 
            padding: 20px;
            flex: 1;
        }
        h2 {
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="date"], input[type="text"], input[type="time"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; // Menyertakan navbar ?>

    <div class="content">
        <h2>Tambah Jadwal Konser</h2>
        <form method="POST" action="">
            <label>Tanggal:</label>
            <input type="date" name="tanggal" required>
            
            <label>Lokasi:</label>
            <input type="text" name="lokasi" required>
            
            <label>Waktu:</label>
            <input type="time" name="waktu" required>
            
            <button type="submit">Tambah Jadwal</button>
        </form>
    </div>
</body>
</html>
