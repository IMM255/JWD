<?php
// if (session_status() === PHP_SESSION_NONE) 
// {
//     session_start();
// }

// Cek apakah admin sudah login
// if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
//     header('Location: index_admin.php'); // Arahkan ke halaman admin
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/datatables/datatables.min.css">
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg px-5 fixed-top " data-bs-theme="dark" style="background-color: #56776C;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Travel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?halaman=home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=home#paketwisata">Paket Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=daftar_pemesanan">Pemesanan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="">
        <?php require("./function/menu.php") ?>
    </main>
    <footer>
        <div class="py-3 text-center text-white " style="background-color: #56776C;">
            Copyright 2024
        </div>
    </footer>

    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>