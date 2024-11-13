<!-- navbar.php -->
<nav>
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        nav {
            width: 200px;
            background-color: #4CAF50;
            padding: 15px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }
        nav h2 {
            color: white;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            margin: 10px 0;
        }
        nav ul li a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        nav ul li a:hover {
            background-color: #45a049;
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
    
    <h2>Dashboard Admin</h2>
    <ul>
        <li><a href="admin_dashboard.php">Dashboard</a></li>
        <li><a href="tambah_jadwal.php">Tambah Jadwal Konser</a></li>
        <li><a href="data_join.php">Data Join</a></li>
        <li><a href="tambah_galeri.php">Tambah Galeri</a></li>
        <li><a href="login.php">Logout</a></li>
    </ul>
</nav>
