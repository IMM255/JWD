<?php 
include "./function/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $jenis_paket = $_POST['jenis_paket'];
    $gambar = $_FILES['gambar']['name']; // Mengambil nama file gambar
    $video = $_POST['video'];

    // Upload gambar ke folder 'uploads'
    $target_dir = "./uploads/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

    // Query untuk menyimpan data paket wisata
    $query = "INSERT INTO wisata (nama_paket, harga, deskripsi, jenis_paket, gambar, video) VALUES ('$nama_paket', '$harga', '$deskripsi', '$jenis_paket', '$gambar', '$video')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Paket wisata berhasil ditambahkan!'); window.location.href='index.php?halaman=admin_wisata';</script>";
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
    <title>Tambah Paket Wisata</title>
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Tambah Paket Wisata</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_paket" class="form-label">Nama Paket</label>
                <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="jenis_paket" class="form-label">Jenis Paket</label>
                <input type="text" class="form-control" id="jenis_paket" name="jenis_paket" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Link Video (YouTube)</label>
                <input type="text" class="form-control" id="video" name="video" placeholder="https://www.youtube.com/watch?v=..." required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Paket Wisata</button>
            <a href="view.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
