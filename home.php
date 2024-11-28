<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username yang sesuai
$password = ""; // Ganti dengan password yang sesuai
$dbname = "galeri_db"; // Nama database yang digunakan

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel galeri
$sql = "SELECT * FROM galeri";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

 <!-- Navbar -->
 <nav class="bg-gray-700">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="text-white text-lg font-bold">Logo</div>
                <div class="hidden md:flex space-x-4">
                    <a class="text-white hover:bg-gray-600 px-3 py-2 rounded" href="home.php">Home</a>
                    <a class="text-white hover:bg-gray-600 px-3 py-2 rounded" href="foto.php">Member JMK</a>
                    <a class="text-white hover:bg-gray-600 px-3 py-2 rounded" href="produk.php">Produk JMK</a>
                    <a class="text-gray-400 cursor-not-allowed px-3 py-2 rounded" href="#">Disabled</a>
                </div>
            </div>
        </div>
    </nav>

 <!-- Foto Sambutan dengan Teks di Tengah -->
<section class="relative">
    <img src="https://wallpapercave.com/wp/wp2051673.jpg" alt="Foto Sambutan" class="w-full h-auto object-cover">
    <div class="absolute inset-0 flex items-center justify-center">
        <h1 class="text-white text-5xl font-extrabold drop-shadow-lg text-center bg-black bg-opacity-50 px-4 py-2 rounded-md">
            Selamat Datang di Website Jomok
        </h1>
    </div>
</section>


            <!-- Tabel Jadwal Konser -->
            <div class="container mx-auto py-8">
    <h2 class="text-3xl font-bold mb-6 text-center">Jadwal Konser</h2>
    <div class="overflow-x-auto">
        <table class="w-full shadow-md rounded-lg overflow-hidden border border-gray-300">
            <thead>
                <tr class="bg-blue-600 text-white uppercase text-sm">
                    <th class="py-4 px-6 text-center">Tanggal</th>
                    <th class="py-4 px-6 text-center">Lokasi</th>
                    <th class="py-4 px-6 text-center">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil data dari tabel jadwal_konser
                $sql = "SELECT * FROM jadwal_konser";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Menampilkan data setiap baris
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border-b border-gray-300 hover:bg-gray-100'>";
                        echo "<td class='py-4 px-6 text-center bg-gray-50'>" . $row["tanggal"] . "</td>";
                        echo "<td class='py-4 px-6 text-center'>" . $row["lokasi"] . "</td>";
                        echo "<td class='py-4 px-6 text-center bg-gray-50'>" . $row["waktu"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='py-4 px-6 text-center text-gray-600'>Tidak ada jadwal konser</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

 
 <!-- Promosi dan Alasan Pendaftaran Section -->
<div class="bg-cover bg-center py-12 text-black" style="background-image: url('https://wallpapercave.com/wp/wp2051821.jpg');">
    <div class="container mx-auto px-6">
        <h2 class="text-center text-4xl font-bold mb-6">Kami Membuka Kesempatan Untuk Jadi bagian dari Band JMK gen13</h2>
        <p class="text-center mb-6">Ayo join dan jadikan diri anda bagian dari band kami yang sangat spektakuler!</p>
        <ul class="list-disc list-inside mx-auto mb-6 max-w-xl">
        </ul>
        <div class="flex justify-center">
            <a href="join_band.php" class="bg-yellow-400 text-gray-800 font-semibold px-8 py-4 rounded-lg shadow-md hover:bg-yellow-500 transition duration-300">Daftar Sekarang</a>
        </div>
    </div>
</div>

<!-- Section Tayangan YouTube -->
<section class="py-12">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-8">Tayangan Kami</h2>
        <div class="flex justify-center gap-6">
            <!-- Video 1 -->
            <div class="w-full sm:w-1/3">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/Xu1wA7CfhQg?si=4CMF7B501WRLqTMV" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <!-- Video 2 -->
            <div class="w-full sm:w-1/3">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/Xu1wA7CfhQg?si=4CMF7B501WRLqTMV" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <!-- Video 3 -->
            <div class="w-full sm:w-1/3">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/Xu1wA7CfhQg?si=4CMF7B501WRLqTMV" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
 
<!-- Section Lokasi Rumah -->
<div class="container mx-auto py-16 px-6 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-lg shadow-xl text-white">
    <h2 class="text-4xl font-extrabold mb-8 text-center">Serlok Tak Parani</h2>
    <div class="flex flex-col lg:flex-row items-center lg:items-start space-y-8 lg:space-y-0 lg:space-x-12">
        <!-- Map Section -->
        <div class="w-full lg:w-1/2 overflow-hidden rounded-lg shadow-lg border-4 border-white">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1015371.6903970228!2d105.96235623161438!3d-6.2246916032343895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14e5ad79c69%3A0x4cba8ea123da1241!2sJKT48%20Theater!5e0!3m2!1sen!2sid!4v1731415831925!5m2!1sen!2sid" 
                width="100%" 
                height="400" 
                class="rounded-lg shadow-lg"
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>

        <!-- Text Section -->
        <div class="w-full lg:w-1/2 p-6 bg-white text-gray-800 rounded-lg shadow-lg">
            <h3 class="text-3xl font-bold mb-6 text-indigo-600">Alamat Kami</h3>
            <p class="text-lg mb-4">
                <span class="font-semibold">Alamat:</span> Jl.Alamat No.123, Kecamatan Example, Kota Sample, Negara Demo.
            </p>
            <p class="text-lg mb-4">
                Lokasi kami berada di pusat kota dengan akses mudah ke berbagai fasilitas umum. Kami siap menyambut kunjungan Anda kapan pun!
            </p>
            <p class="text-lg">
                Untuk informasi lebih lanjut, silakan hubungi kami melalui telepon atau email yang tercantum di halaman kontak kami.
            </p>
        </div>
    </div>
</div>

<!-- Foto Pembuat Web -->
<div class="container mx-auto mt-12 mb-12">
    <h2 class="text-center text-3xl font-semibold text-gray-800 mb-8">Pembuat Web</h2>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        <div class="team-member text-center transition-transform transform hover:scale-105">
            <img src="https://via.placeholder.com/150" 
                 class="w-36 h-36 rounded-full mx-auto mb-4 border-4 border-transparent hover:border-indigo-400 shadow-lg hover:shadow-2xl transition-shadow duration-300" 
                 alt="Member 1">
            <h5 class="text-gray-800 font-semibold hover:text-indigo-600">Nama Pembuat 1</h5>
            <p class="text-sm text-gray-500">Developer</p>
        </div>
        <div class="team-member text-center transition-transform transform hover:scale-105">
            <img src="https://via.placeholder.com/150" 
                 class="w-36 h-36 rounded-full mx-auto mb-4 border-4 border-transparent hover:border-indigo-400 shadow-lg hover:shadow-2xl transition-shadow duration-300" 
                 alt="Member 2">
            <h5 class="text-gray-800 font-semibold hover:text-indigo-600">Nama Pembuat 2</h5>
            <p class="text-sm text-gray-500">Designer</p>
        </div>
        <div class="team-member text-center transition-transform transform hover:scale-105">
            <img src="https://via.placeholder.com/150" 
                 class="w-36 h-36 rounded-full mx-auto mb-4 border-4 border-transparent hover:border-indigo-400 shadow-lg hover:shadow-2xl transition-shadow duration-300" 
                 alt="Member 3">
            <h5 class="text-gray-800 font-semibold hover:text-indigo-600">Nama Pembuat 3</h5>
            <p class="text-sm text-gray-500">Project Manager</p>
        </div>
        <div class="team-member text-center transition-transform transform hover:scale-105">
            <img src="https://via.placeholder.com/150" 
                 class="w-36 h-36 rounded-full mx-auto mb-4 border-4 border-transparent hover:border-indigo-400 shadow-lg hover:shadow-2xl transition-shadow duration-300" 
                 alt="Member 4">
            <h5 class="text-gray-800 font-semibold hover:text-indigo-600">Nama Pembuat 4</h5>
            <p class="text-sm text-gray-500">Tester</p>
        </div>
        <div class="team-member text-center transition-transform transform hover:scale-105">
            <img src="https://via.placeholder.com/150" 
                 class="w-36 h-36 rounded-full mx-auto mb-4 border-4 border-transparent hover:border-indigo-400 shadow-lg hover:shadow-2xl transition-shadow duration-300" 
                 alt="Member 5">
            <h5 class="text-gray-800 font-semibold hover:text-indigo-600">Nama Pembuat 5</h5>
            <p class="text-sm text-gray-500">Support</p>
        </div>
    </div>
</div>

   <!-- About Section -->
   <div class="bg-white text-center py-10">
        <div class="container mx-auto">
            <h2 class="text-3xl text-gray-800 mb-4">Tentang Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Kami adalah tim pengembang web yang berdedikasi untuk memberikan solusi inovatif dan efisien untuk kebutuhan Anda.</p>
        </div>
    </div>

    <footer class="bg-gray-900 text-white text-center py-4">
        <p>&copy; 2024 Galeri Band JMK - Semua Hak Dilindungi</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
