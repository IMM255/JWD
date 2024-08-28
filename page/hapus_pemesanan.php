<?php 
include "./function/koneksi.php";

// Cek jika ID paket wisata ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus paket wisata berdasarkan ID
    $query = "DELETE FROM pemesanan WHERE id='$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pemesanan berhasil dihapus!'); window.location.href='index.php?halaman=daftar_pemesanan';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='index.php?halaman=daftar_pemesanan';</script>";
    }
} else {
    echo "<script>alert('ID pemesanan tidak ditemukan!'); window.location.href='index.php?halaman=daftar_pemesanan';</script>";
}
?>
