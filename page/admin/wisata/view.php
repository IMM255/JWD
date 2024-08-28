<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    if (!isset($_SESSION['admin'])) {
        header("Location: index.php?halaman=login");
        exit();
    }
    include "./function/koneksi.php";

    $query = mysqli_query($koneksi, "SELECT * FROM wisata ");
?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Daftar Paket Wisata</h2>
                <a href="index.php?halaman=tambah_wisata" class="btn btn-primary">Tambah Paket Wisata</a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="table-wisata">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($query)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nama_paket']; ?></td>
                                <td><?php echo $row['harga']; ?></td>
                                <td><?php echo $row['deskripsi']; ?></td>
                                <td>
                                <!-- Tampilkan gambar -->
                                <img src="../../../uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_paket']; ?>" width="100">
                            </td>
                                <td>
                                    <a href="index.php?halaman=ubah_wisata&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">EDIT</a>
                                    <a href="index.php?halaman=hapus_wisata&id=<?php echo $row['id']; ?>" onclick="return confirm('Apa kamu yakin?')" class="btn btn-sm btn-danger">DELETE</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

