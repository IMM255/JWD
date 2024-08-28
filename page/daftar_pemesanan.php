<?php 
    include "./function/koneksi.php";

    $query = mysqli_query($koneksi, "SELECT * FROM pemesanan ");
?>

<div class="container mt-5 pt-5">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Pemesanan yang telah dibuat</h2>
</div>

<div class="table-responsive">
    <table class="table table-bordered" id="table-pemesanan">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nama Pemesan</th>
                <th>Waktu Pelaksanaan</th>
                <th>Jumlah Peserta</th>
                <th>Harga Paket</th>
                <th>Harga Total</th>
                <th>layanan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama_pemesan']; ?></td>
                <td><?php echo $row['waktu_pelaksanaan']; ?></td>
                <td><?php echo $row['jumlah_peserta']; ?></td>
                <td><?php echo $row['harga_paket']; ?></td>
                <td><?php echo $row['harga_total']; ?></td>
                <td><?php echo $row['layanan']; ?></td>
                <td>
                    <a href="index.php?halaman=ubah_pemesanan&id=<?php echo $row['id']; ?>"
                        class="btn btn-sm btn-warning">EDIT</a>
                    <a href="../page/cetak_pemesanan.php?id=<?php echo $row['id']; ?>"
                        class="btn btn-sm btn-info">Cetak</a>
                    <a href="index.php?halaman=hapus_pemesanan&id=<?php echo $row['id']; ?>"
                        onclick="return confirm('Apa kamu yakin?')" class="btn btn-sm btn-danger">DELETE</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</div>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="assets/datatables/datatables.min.js"></script>
            <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#table-pemesanan').DataTable(); // Inisialisasi DataTables
                });
    </script>