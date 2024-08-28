<!-- index.php -->
<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
    // Admin sudah login, tampilkan halaman dengan navigasi admin
    include 'index_admin.php';
} else {
    //tampilkan halaman biasa
    include 'index_pengunjung.php';
}
?>
