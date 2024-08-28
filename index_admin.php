<!-- login.php -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="../../../assets/datatables/datatables.min.css">

</head>

<body>
    <!-- sidebar -->
    <div class="wrapper">
       <!-- Sidebar -->
        <?php require("./layout/admin/sidebar.php") ?>
       <!-- Sidebar -->
        <main class="p-5">
        <?php require("./function/menu.php") ?>
        </main>
    </div>


    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="assets/datatables/datatables.min.js"></script>
            <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#table-wisata').DataTable(); // Inisialisasi DataTables
                });
    </script>
</body>

</html>


