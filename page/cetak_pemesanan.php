<?php
require '../assets/dompdf/autoload.inc.php'; // Pastikan DomPDF sudah diinstal dan autoload diikutkan
use Dompdf\Dompdf;

include "../function/koneksi.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id = $id");
$pemesanan = mysqli_fetch_assoc($query);

if (!$pemesanan) {
    echo "Data pemesanan tidak ditemukan.";
    exit;
}

$dompdf = new Dompdf();

// Desain HTML untuk dicetak
$html = '
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>

<h2>Detail Pemesanan</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID Pemesanan</th>
        <td>' . $pemesanan['id'] . '</td>
    </tr>
    <tr>
        <th>Nama Pemesan</th>
        <td>' . $pemesanan['nama_pemesan'] . '</td>
    </tr>
    <tr>
        <th>Waktu Pelaksanaan</th>
        <td>' . $pemesanan['waktu_pelaksanaan'] . '</td>
    </tr>
    <tr>
        <th>Jumlah Peserta</th>
        <td>' . $pemesanan['jumlah_peserta'] . '</td>
    </tr>
    <tr>
        <th>Harga Paket</th>
        <td>' . $pemesanan['harga_paket'] . '</td>
    </tr>
    <tr>
        <th>Harga Total</th>
        <td>' . $pemesanan['harga_total'] . '</td>
    </tr>
    <tr>
        <th>Layanan</th>
        <td>' . $pemesanan['layanan'] . '</td>
    </tr>
</table>';

// Memuat konten HTML ke Dompdf
$dompdf->loadHtml($html);

// Mengatur ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');

// Render HTML ke PDF
$dompdf->render();

// Mengirimkan PDF ke browser untuk diunduh atau ditampilkan
$dompdf->stream("pemesanan_" . $pemesanan['id'] . ".pdf", array("Attachment" => false));
?>
