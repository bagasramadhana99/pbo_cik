<?php
session_start();
// Pastikan pengguna sudah login sebagai admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$host = "localhost";
$dbname = "galeri_db"; 
$username = "root";
$password = ""; 

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil jumlah anggota band dari tabel band_member_new
$sql_band_members = "SELECT COUNT(*) AS total_band_members FROM band_members_new";
$result_band_members = $conn->query($sql_band_members);
$row_band_members = $result_band_members->fetch_assoc();
$total_band_members = $row_band_members['total_band_members'];

// Ambil data lain yang diperlukan, misalnya galeri dan jadwal konser
$sql_galeri = "SELECT COUNT(*) AS total_galeri FROM galeri";
$result_galeri = $conn->query($sql_galeri);
$row_galeri = $result_galeri->fetch_assoc();
$total_galeri = $row_galeri['total_galeri'];

$sql_jadwal = "SELECT COUNT(*) AS total_jadwal FROM jadwal_konser";
$result_jadwal = $conn->query($sql_jadwal);
$row_jadwal = $result_jadwal->fetch_assoc();
$total_jadwal = $row_jadwal['total_jadwal'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f9;
        }
        .content {
            padding: 20px;
            flex: 1; /* Mengisi sisa ruang */
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
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
        <h1>Selamat Datang di Dashboard Admin</h1>
        <p>Statistik Data</p>
        <canvas id="dataChart"></canvas>
        
        <script>
            const ctx = document.getElementById('dataChart').getContext('2d');
            const dataChart = new Chart(ctx, {
                type: 'bar', // Jenis chart: bar, line, pie, dll.
                data: {
                    labels: ['pendaftar', 'Galeri', 'Jadwal Konser'],
                    datasets: [{
                        label: 'Jumlah Data',
                        data: [<?php echo $total_band_members; ?>, <?php echo $total_galeri; ?>, <?php echo $total_jadwal; ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</body>
</html>
