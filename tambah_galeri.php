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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>

<?php include 'navbar.php'; // Menyertakan navbar ?>

<div class="content">
    <h2>Tambah Galeri</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="artist_name" class="form-label">Nama Artis</label>
            <input type="text" class="form-control" id="artist_name" name="artist_name" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
