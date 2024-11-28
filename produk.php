<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include koneksi database
include 'koneksi.php';

// Ambil data dari tabel produk
$sql = "SELECT * FROM produk";
$result = $conn->query($sql);

if (!$result) {
    die("Error: " . $conn->error); // Debug SQL error
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Tombol WhatsApp di pojok kanan bawah */
        #whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25D366; /* Warna hijau WhatsApp */
            color: white;
            border: none;
            border-radius: 50%;
            padding: 15px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #whatsapp-button:hover {
            background-color: #128C7E;
        }

        /* Popup WhatsApp */
        .whatsapp-popup {
            position: fixed;
            bottom: 80px;
            right: 20px;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            border-radius: 10px;
            display: none;
            z-index: 9998;
        }

        .whatsapp-popup h3 {
            margin-top: 0;
        }

        .whatsapp-popup button {
            background-color: #25D366;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .whatsapp-popup button:hover {
            background-color: #128C7E;
        }

        /* Pesan Mengambang di atas tombol WhatsApp */
        #message-popup {
            position: fixed;
            bottom: 70px;
            right: 20px;
            background-color: rgba(0, 0, 0, 0.8); /* Background gelap dengan transparansi */
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            z-index: 9997;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Tombol tutup untuk pesan */
        #close-popup {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: transparent;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

    </style>
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
                    <a class="text-white hover:bg-gray-600 px-3 py-2 rounded" href="produk.php">Produk JMK</a>
                    <a class="text-gray-400 cursor-not-allowed px-3 py-2 rounded" href="#">Disabled</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Produk Kami -->
    <div class="container mx-auto mt-8">
        <h1 class="text-center text-3xl font-bold mb-6">Produk Kami</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            // Cek apakah ada hasil
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg">';
                    echo '<img src="' . htmlspecialchars($row['image_path']) . '" class="w-full h-48 object-cover" alt="' . htmlspecialchars($row['product_name']) . '">';
                    echo '<div class="p-4">';
                    echo '<h5 class="text-lg font-semibold">' . htmlspecialchars($row['product_name']) . '</h5>';
                    echo '<p class="text-gray-600">' . htmlspecialchars($row['description']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center text-gray-600">Tidak ada produk yang tersedia.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Tombol WhatsApp -->
    <button id="whatsapp-button" onclick="togglePopup()">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="30" height="30">
    </button>

    <!-- Pesan Mengambang -->
    <div id="message-popup">
        <span>Pesan Disini!</span>
    </div>

    <!-- Popup WhatsApp -->
    <div class="whatsapp-popup" id="whatsapp-popup">
        <h3>Hubungi Kami via WhatsApp</h3>
        <p>Jika Anda memiliki pertanyaan, kirimkan pesan melalui WhatsApp.</p>
        <a href="https://wa.me/1234567890" target="_blank">
            <button>Chat Sekarang</button>
        </a>
    </div>

    <script>
        // Fungsi untuk menampilkan dan menyembunyikan popup WhatsApp
        function togglePopup() {
            const popup = document.getElementById('whatsapp-popup');
            const display = popup.style.display;
            popup.style.display = (display === 'none' || display === '') ? 'block' : 'none';
        }

        // Fungsi untuk menutup pesan mengambang
        function closeMessagePopup() {
            const messagePopup = document.getElementById('message-popup');
            messagePopup.style.display = 'none';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
