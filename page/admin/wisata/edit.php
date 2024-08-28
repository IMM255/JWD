<?php 
include "./function/koneksi.php";

// Cek jika ID paket wisata ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data paket wisata berdasarkan ID
    $query = mysqli_query($koneksi, "SELECT * FROM wisata WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);

    // Cek jika data tidak ditemukan
    if (!$data) {
        echo "<script>alert('Paket wisata tidak ditemukan!'); window.location.href='index.php?halaman=ubah_wisata';</script>";
        exit;
    }
}

// Proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $jenis_paket = $_POST['jenis_paket'];
    $video = $_POST['video'];

    // Cek apakah gambar baru diupload
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "./uploads/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
        // Update gambar di query
        $query_update = "UPDATE wisata SET nama_paket='$nama_paket', harga='$harga', deskripsi='$deskripsi', jenis_paket='$jenis_paket', gambar='$gambar', video='$video' WHERE id='$id'";
    } else {
        // Jika tidak ada gambar baru, update tanpa mengganti gambar
        $query_update = "UPDATE wisata SET nama_paket='$nama_paket', harga='$harga', deskripsi='$deskripsi', jenis_paket='$jenis_paket', video='$video' WHERE id='$id'";
    }

    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>alert('Paket wisata berhasil diupdate!'); window.location.href='index.php?halaman=admin_wisata';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>


    <div class="container mt-5">
        <h2>Edit Paket Wisata</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_paket" class="form-label">Nama Paket</label>
                <input type="text" class="form-control" id="nama_paket" name="nama_paket" value="<?php echo $data['nama_paket']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $data['harga']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?php echo $data['deskripsi']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="jenis_paket" class="form-label">Jenis Paket</label>
                <input type="text" class="form-control" id="jenis_paket" name="jenis_paket" value="<?php echo $data['jenis_paket']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar (Kosongkan jika tidak ingin mengubah)</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                <small class="form-text text-muted">Current image: <?php echo $data['gambar']; ?></small>
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Link Video (YouTube)</label>
                <input type="text" class="form-control" id="video" name="video" value="<?php echo $data['video']; ?>" placeholder="https://www.youtube.com/watch?v=...">
            </div>
            <button type="submit" class="btn btn-primary">Update Paket Wisata</button>
            <a href="view.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

