<?php
include "./function/koneksi.php";

// Ambil ID pemesanan dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data pemesanan berdasarkan ID
$query = "SELECT * FROM pemesanan WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$pemesanan = mysqli_fetch_assoc($result);

if (!$pemesanan) {
    echo "<script>alert('Data pemesanan tidak di temukan.'); window.location.href='daftar_pemesanan.php';</script>";
    exit;
}

// Proses pembaruan data jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pemesan = htmlspecialchars($_POST['nama_pemesan']);
    $nomor_telp = htmlspecialchars($_POST['nomor_telp']);
    $waktu_pelaksanaan = intval($_POST['waktu_pelaksanaan']);
    $jumlah_peserta = intval($_POST['jumlah_peserta']);
    $harga_paket = floatval($_POST['harga_paket']);
    $harga_total = floatval($_POST['harga_total']);
    $layanan_str = implode(", ", $_POST['layanan'] ?? []);

    $sql = "UPDATE pemesanan SET 
                nama_pemesan = '$nama_pemesan', 
                nomor_telp = '$nomor_telp', 
                waktu_pelaksanaan = $waktu_pelaksanaan, 
                jumlah_peserta = $jumlah_peserta, 
                harga_paket = $harga_paket, 
                harga_total = $harga_total, 
                layanan = '$layanan_str' 
            WHERE id = $id";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data pemesanan berhasil diperbarui!'); window.location.href='index.php?halaman=daftar_pemesanan';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemesanan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container pt-5 my-5">
    <h2 class="text-center my-4">Edit Pemesanan</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="nama_pemesan" class="form-label">Nama Pemesan:</label>
            <input type="text" class="form-control" name="nama_pemesan" value="<?php echo htmlspecialchars($pemesanan['nama_pemesan']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="nomor_telp" class="form-label">Nomor Telepon:</label>
            <input type="tel" class="form-control" name="nomor_telp" value="<?php echo htmlspecialchars($pemesanan['nomor_telp']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="waktu_pelaksanaan" class="form-label">Waktu Pelaksanaan Perjalanan : (dalam hari)</label>
            <input id="waktu_pelaksanaan" type="number" class="form-control" name="waktu_pelaksanaan" value="<?php echo intval($pemesanan['waktu_pelaksanaan']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_peserta" class="form-label">Jumlah Peserta:</label>
            <input id="jumlah_peserta" type="number" class="form-control" name="jumlah_peserta" value="<?php echo intval($pemesanan['jumlah_peserta']); ?>" min="1" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pelayanan Paket Perjalanan:</label><br>
            <?php
            $layanan_terpilih = explode(", ", $pemesanan['layanan']);
            $layanan_harga = [
                'Penginapan' => 1200000,
                'Transportasi' => 1000000,
                'Makanan' => 500000,
            ];
            foreach ($layanan_harga as $layanan => $harga) {
                $checked = in_array($layanan, $layanan_terpilih) ? 'checked' : '';
                echo '<input class="layanan-checkbox" type="checkbox" name="layanan[]" value="' . $layanan . '" ' . $checked . '> ' . $layanan . '<br>';
            }
            ?>
        </div>
        <div class="mb-3">
            <label for="harga_paket" class="form-label">Harga Paket Perjalanan:</label>
            <input id="harga_paket" type="text" class="form-control" name="harga_paket" value="<?php echo floatval($pemesanan['harga_paket']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="harga_total" class="form-label">Jumlah Tagihan:</label>
            <input id="jumlah_tagihan" type="text" class="form-control" name="harga_total" value="<?php echo floatval($pemesanan['harga_total']); ?>" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="daftar_pemesanan.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hargaPaket = parseFloat(document.getElementById('harga_paket').value);
    const layananHarga = {
        'Penginapan': 1200000,
        'Transportasi': 1000000,
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
