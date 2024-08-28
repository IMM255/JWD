<?php
if (isset($_GET['halaman'])) {
    $halaman = $_GET['halaman'];
    switch ($halaman) {
        case 'home':
            include "page/home.php";
            break;
        case '/':
            include "page/home.php";
            break;
        case 'dasbor':
            include "page/admin/index.php";
            break;
        case 'admin_wisata':
            include "page/admin/wisata/view.php";
            break;
        case 'tambah_wisata':
            include "page/admin/wisata/add.php";
            break;
        case 'ubah_wisata':
            include "page/admin/wisata/edit.php";
            break;
        case 'hapus_wisata':
            include "page/admin/wisata/delete.php";
            break;
        case 'detail_paket':
            include "page/detail_paket.php";
            break;
        case 'pemesanan':
            include "page/pemesanan.php";
            break;
        case 'daftar_pemesanan':
            include "page/daftar_pemesanan.php";
            break;
        case 'ubah_pemesanan':
            include "page/ubah_pemesanan.php";
            break;
        case 'hapus_pemesanan':
            include "page/hapus_pemesanan.php";
            break;
        case 'cetak_pemesanan':
            include "page/cetak_pemesanan.php";
            break;
        default:
            include "page/error.php";
    }
} else {
    include "page/admin/index.php";
}

?>