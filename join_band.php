<?php
include 'koneksi.php'; // Koneksi ke database

$message = ''; // Variable untuk menyimpan pesan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $talent = $_POST['talent'];
    $email = $_POST['email'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi ukuran file
    if ($_FILES["photo"]["size"] > 500000) {
        $message = "<div class='alert alert-warning'>Ukuran file terlalu besar (maksimal 500KB).</div>";
        $uploadOk = 0;
    }

    // Validasi tipe file
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        $message = "<div class='alert alert-warning'>Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.</div>";
        $uploadOk = 0;
    }

    // Jika semua validasi berhasil
    if ($uploadOk == 1) {
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        // Upload file gambar
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Simpan data ke database
            $sql = "INSERT INTO band_members_new (name, age, talent, photo_path, email) VALUES ('$name', '$age', '$talent', '$target_file', '$email')";
            if ($conn->query($sql) === TRUE) {
                $message = "<div class='alert alert-success'>Pendaftaran berhasil! Kami akan menghubungi Anda segera.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Terjadi kesalahan: " . $conn->error . "</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Kesalahan saat mengupload foto.</div>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Band JMK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('frybg.jpg'); /* Ganti dengan lokasi gambar Anda */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            backdrop-filter: blur(4px); /* Tambahan efek blur untuk memperjelas form di atas background */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9); /* Transparansi untuk card */
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 2rem;
            width: 100%;
            max-width: 500px;
        }
        h2 {
            color: #333;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .alert {
            position: fixed; /* Memperbaiki posisi alert */
            top: 50%; /* Posisi vertikal tengah */
            left: 50%; /* Posisi horizontal tengah */
            transform: translate(-50%, -50%); /* Memindahkan agar benar-benar di tengah */
            z-index: 1050; /* Menempatkan alert di atas elemen lain */
            width: auto; /* Atur lebar alert */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h2 class="text-center mb-4">Join Band JMK</h2>
                    <?php if ($message): ?>
                        <?php echo $message; ?>
                    <?php endif; ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Umur</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label for="talent" class="form-label">Talenta</label>
                            <input type="text" class="form-control" id="talent" name="talent" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="photo" name="photo" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
