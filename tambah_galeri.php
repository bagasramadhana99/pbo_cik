<?php
session_start();
// Pastikan pengguna sudah login sebagai admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'koneksi.php'; // Menyertakan file koneksi

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Galeri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }
        /* Menambahkan margin kiri untuk memberikan ruang setelah navbar */
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 220px; /* Sesuaikan dengan lebar navbar */
        }
       
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            color: #333;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-group input[type="file"] {
            padding: 5px;
        }
        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .alert {
            padding: 10px;
            margin-top: 15px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; // Menyertakan navbar ?>

<div class="container">
    <h2>Tambah Galeri</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="artist_name">Nama Artis</label>
            <input type="text" id="artist_name" name="artist_name" required>
        </div>
        <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" id="image" name="image" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn">Simpan</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $artist_name = $_POST['artist_name'];
        $description = $_POST['description'];

        // Menangani upload gambar
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek jika file gambar sudah ada
        if (file_exists($target_file)) {
            echo "<div class='alert alert-danger'>Maaf, file sudah ada.</div>";
            $uploadOk = 0;
        }

        // Cek ukuran file
        if ($_FILES["image"]["size"] > 500000) {
            echo "<div class='alert alert-danger'>Maaf, ukuran file terlalu besar.</div>";
            $uploadOk = 0;
        }

        // Hanya izinkan format file tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<div class='alert alert-danger'>Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.</div>";
            $uploadOk = 0;
        }

        // Cek apakah $uploadOk diatur ke 0 oleh kesalahan
        if ($uploadOk == 0) {
            echo "<div class='alert alert-danger'>Maaf, file tidak dapat diupload.</div>";
        } else {
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO galeri (artist_name, image_path, description) VALUES ('$artist_name', '$target_file', '$description')";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>Data berhasil ditambahkan.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Maaf, terjadi kesalahan saat mengupload file.</div>";
            }
        }
    }

    if (isset($conn)) {
        $conn->close(); // Menutup koneksi
    }
    ?>
</div>

</body>
</html>
