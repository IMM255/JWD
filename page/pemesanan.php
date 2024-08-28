<?php
include "./function/koneksi.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = mysqli_query($koneksi, "SELECT * FROM wisata WHERE id = $id");
$paket = mysqli_fetch_assoc($query);

if (!$paket) {
    echo "Paket wisata tidak ditemukan.";
    exit;
}

$harga_paket = $paket['harga']; // Harga paket dari database
$jumlah_hari = 0; // Jumlah hari perjalanan
$jumlah_peserta = 0; // Inisialisasi jumlah peserta
$jumlah_tagihan = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_pemesan = htmlspecialchars($_POST['nama_pemesan']);
    $nomor_telp = htmlspecialchars($_POST['nomor_telp']);
    $waktu_pelaksanaan = intval($_POST['waktu_pelaksanaan']);
    $jumlah_peserta = intval($_POST['jumlah_peserta']);

    // Hitung harga total paket
    $harga_total = $harga_paket; // Menggunakan harga paket dasar

    // Menentukan harga layanan tambahan
    $layanan_harga = [
        'Penginapan' => 1200000,
        'Transportasi' => 1000000,
        'Makanan' => 500000,
    ];

    // Hitung total harga berdasarkan layanan yang dipilih
    if (isset($_POST['layanan'])) {
        foreach ($_POST['layanan'] as $layanan) {
            if (array_key_exists($layanan, $layanan_harga)) {
                $harga_total += $layanan_harga[$layanan]; // Tambahkan harga layanan ke total
            }
        }
    }

    // Hitung jumlah tagihan berdasarkan jumlah hari dan peserta
    $jumlah_tagihan = $jumlah_hari * $jumlah_peserta * $harga_total;

    // Simpan data pemesanan ke dalam tabel pemesan
    $layanan_str = implode(", ", $_POST['layanan'] ?? []);
    $sql = mysqli_query($koneksi, "INSERT INTO pemesanan (nomor_telp, waktu_pelaksanaan, jumlah_peserta, nama_pemesan, harga_paket, harga_total, layanan) VALUES ( '$nomor_telp', '$waktu_pelaksanaan', '$jumlah_peserta', '$nama_pemesan', '$harga_paket', '$harga_total', '$layanan_str')");

    echo "nama_pemesan: $nama_pemesan, nomor_telp: $nomor_telp, waktu_pelaksanaan: $waktu_pelaksanaan, jumlah_peserta: $jumlah_peserta, harga_paket: $harga_paket, harga_total: $harga_total, layanan: $layanan_str";

    if( $sql == TRUE ){
        echo "<script>alert('Berhasil Membuat pesanan!'); window.location.href='index.php?halaman=daftar_pemesanan';</script>";
    }
}
?>

<div class="container pt-5 my-5">
    <h2 class="text-center my-4">Form Pemesanan</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="nama_pemesan" class="form-label">Nama Pemesan:</label>
            <input type="text" class="form-control" name="nama_pemesan" required>
        </div>
        <div class="mb-3">
            <label for="nomor_telp" class="form-label">Nomor Telepon:</label>
            <input type="tel" class="form-control" name="nomor_telp" required>
        </div>
        <div class="mb-3">
            <label for="waktu_pelaksanaan" class="form-label">Waktu Pelaksanaan Perjalanan : (dalam hari)</label>
            <input id="waktu_pelaksanaan" type="number" class="form-control" name="waktu_pelaksanaan" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_peserta" class="form-label">Jumlah Peserta:</label>
            <input id="jumlah_peserta" type="number" class="form-control" name="jumlah_peserta" min="1" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pelayanan Paket Perjalanan:</label><br>
            <input type="checkbox" name="layanan[]" value="Penginapan" class="layanan-checkbox"> Penginapan<br>
            <input type="checkbox" name="layanan[]" value="Transportasi" class="layanan-checkbox"> Transportasi<br>
            <input type="checkbox" name="layanan[]" value="Makanan" class="layanan-checkbox"> Makanan<br>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Paket Perjalanan:</label>
            <input id="harga_paket" type="text" class="form-control" value="<?php echo htmlspecialchars($harga_paket); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="jumlah_tagihan" class="form-label">Jumlah Tagihan:</label>
            <input id="jumlah_tagihan" type="text" class="form-control" value="<?php echo isset($jumlah_tagihan) ? $jumlah_tagihan : ''; ?>" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Pesan</button>
    </form>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const hargaPaket = parseFloat(document.getElementById('harga_paket').value);
    const layananHarga = {
        'Penginapan': 1000000,
        'Transportasi': 1200000,
        'Makanan': 500000
    };
    
    function updateTotal() {
        let total = hargaPaket;
        let jumlahHari = parseInt(document.getElementById('waktu_pelaksanaan').value) || 0;
        let jumlahPeserta = parseInt(document.getElementById('jumlah_peserta').value) || 0;

        document.querySelectorAll('.layanan-checkbox:checked').forEach(function(checkbox) {
            total += layananHarga[checkbox.value];
        });
        
        let jumlahTagihan = total * jumlahHari * jumlahPeserta;
        document.getElementById('jumlah_tagihan').value = jumlahTagihan;
    }
    
    document.querySelectorAll('.layanan-checkbox, #waktu_pelaksanaan, #jumlah_peserta').forEach(function(element) {
        element.addEventListener('change', updateTotal);
    });

    updateTotal(); // Hitung total saat pertama kali halaman dimuat
});
</script>