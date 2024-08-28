<?php

include "./function/koneksi.php";

// Ambil ID paket dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data paket wisata berdasarkan ID
    $query = mysqli_query($koneksi, "SELECT * FROM wisata WHERE id='$id'");
    $paket = mysqli_fetch_assoc($query);

    // Cek jika data tidak ditemukan
    if (!$paket) {
        echo "<script>alert('Paket wisata tidak ditemukan!'); window.location.href='index.php?halaman=ubah_wisata';</script>";
        exit;
    }
}

$query = mysqli_query($koneksi, "SELECT * FROM wisata ");

?>
    <iframe width="100%" height="500" src="<?= $paket['video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    <div class="container">
        <section class="py-5">
            <div class="row">
                <div class="col-8">
                    <div class="text-center">
                        <h2><?= $paket['nama_paket'] ?></h2>    
                        <p>
                            <?= $paket['deskripsi'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card mb-3">
                        <div class="card-body">
                          <h5 class="card-title"><?= $paket['nama_paket'] ?></h5>
                          <p class="m-0 pb-2" >Harga : <?= $paket['harga'] ?> </p>
                            <div class="text-center">
                                <a href="index.php?halaman=pemesanan&id=<?= $paket['id'] ?>" class="btn btn-success">Pesan</a>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row mt-5 py-3">
                <div class="col-12">
                    <img class="w-100" src="./uploads/<?= $paket['gambar']; ?>" alt="">
                </div>
            </div>
        </section>
    </div>
