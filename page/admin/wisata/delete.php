<?php 
include "./function/koneksi.php";

// Cek jika ID paket wisata ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus paket wisata berdasarkan ID
    $query = "DELETE FROM wisata WHERE id='$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Paket wisata berhasil dihapus!'); window.location.href='index.php?halaman=admin_wisata';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='index.php?halaman=admin_wisata';</script>";
    }
} else {
    echo "<script>alert('ID paket wisata tidak ditemukan!'); window.location.href='index.php?halaman=admin_wisata';</script>";
}
?>
