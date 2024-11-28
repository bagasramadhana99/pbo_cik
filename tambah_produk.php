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
$dbname = "galeri_db"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menyimpan data produk jika form dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];

    // Pastikan file gambar diterima
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = 'uploads/' . $image_name; // Menentukan direktori penyimpanan

        // Menyimpan gambar di folder 'uploads'
        if (move_uploaded_file($image_tmp, $image_path)) {
            $sql = "INSERT INTO produk (product_name, description, image_path) VALUES ('$product_name', '$description', '$image_path')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Produk berhasil ditambahkan.');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Gagal mengunggah gambar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
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
        input[type="text"], textarea, input[type="file"] {
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
        <h2>Tambah Produk</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <label>Nama Produk:</label>
            <input type="text" name="product_name" required>
            
            <label>Deskripsi:</label>
            <textarea name="description" rows="4" required></textarea>
            
            <label>Gambar Produk:</label>
            <input type="file" name="image" required>
            
            <button type="submit">Tambah Produk</button>
        </form>
    </div>

</body>
</html>
