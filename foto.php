<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php'; // Include koneksi database

// Ambil data dari tabel galeri
$sql = "SELECT * FROM galeri";
$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $conn->error; // Debug SQL error
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800">

    <!-- Navbar -->
    <nav class="bg-gray-700">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="text-white text-lg font-bold">Logo</div>
                <div class="hidden md:flex space-x-4">
                    <a class="text-white hover:bg-gray-600 px-3 py-2 rounded" href="home.php">Home</a>
                    <a class="text-white hover:bg-gray-600 px-3 py-2 rounded" href="foto.php">Member JMK</a>
                    <div class="relative">
                        <button class="text-white hover:bg-gray-600 px-3 py-2 rounded">Contact Me</button>
                        <div class="absolute hidden group-hover:block bg-white text-gray-800 rounded shadow-lg mt-1">
                            <a class="block px-4 py-2 hover:bg-gray-200" href="#">Whatsapp</a>
                            <hr class="border-gray-300">
                            <a class="block px-4 py-2 hover:bg-gray-200" href="#">Instagram</a>
                        </div>
                    </div>
                    <a class="text-gray-400 cursor-not-allowed px-3 py-2 rounded" href="#">Disabled</a>
                </div>
            </div>
        </div>
    </nav>


    <div class="container mx-auto mt-4">
        <h1 class="text-center text-3xl font-bold mb-6">Galeri</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            // Cek apakah ada hasil
            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                while($row = $result->fetch_assoc()) {
                    echo '<div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg">';
                    echo '<img src="' . htmlspecialchars($row['image_path']) . '" class="w-full h-48 object-cover" alt="' . htmlspecialchars($row['artist_name']) . '">';
                    echo '<div class="p-4">';
                    echo '<h5 class="text-lg font-semibold">' . htmlspecialchars($row['artist_name']) . '</h5>';
                    echo '<p class="text-gray-600">' . htmlspecialchars($row['description']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center text-gray-600">Tidak ada gambar dalam galeri.</p>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
