<?php

include "./function/koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM wisata ");

?>

<header class="text-center">
    <h1>
        Wisata Alam
        <br>
        Wisata
    </h1>
    <p class="mt-3">
        tempat yang menenangkan
        <br>
        moment you never see
    </p>
</header>


<section id="paketTravel">
    <div class="container">
        <h2 id="paketwisata" class="text-center my-4">Paket Wisata</h2>
        <div class="row">
            <?php while ($paket = mysqli_fetch_assoc($query)): ?>
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="card-travel text-center d-flex flex-column shadow rounded "
                    style="background-image: url('./uploads/<?= $paket['gambar']; ?>');">
                    <div class="travel-paket"><?= ($paket['jenis_paket'])  ?></div>
                    <div class="travel-name"><?= ($paket['nama_paket'])  ?></div>
                    <div class="travel-button mt-auto">
                        <a href="index.php?halaman=detail_paket&id=<?= $paket['id']; ?>"
                            class="btn btn-travel-details px-4">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<section id="gallery" class="mt-5">
    <div class="container">
        <h2 class="text-center my-4">Gallery</h2>
        <div class="row">
            <div class="col-8">
                <img class="w-100 h-100 lg-h-75 object-fit-cover radius shadow-lg rounded" src="./assets/img/nature.jpg"
                    alt="">
            </div>
            <div class="col-4">
                <img class="w-100 h-100 object-fit-cover radius shadow-lg rounded" src="./assets/img/hero.jpg" alt="">
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-4">
                <img class="w-100 h-100 object-fit-cover radius shadow-lg rounded" src="./assets/img/pantai.jpg" alt="">
            </div>
            <div class="col-8">
                <img class="w-100 h-100 object-fit-cover radius shadow-lg rounded" src="./assets/img/gunung.jpg" alt="">
            </div>
        </div>
    </div>
</section>
<section id="about" class="my-5">
    <div class="container">
        <h2 class="my-3 text-center">Travel</h2>
        <div class="row">
            <div class="col-7">
                <img class="w-100 rounded shadow" src="./assets/img/hero.jpg" alt="img-about">
            </div>
            <div class="col-5">
                <div>
                    <h3>200+ Paket Travel</h3>
                    <p>Lebih dari 200+ paket travel tersedia</p>
                </div>
                <div>
                    <h3>50+ Perjalanan</h3>
                    <p>Lebih dari 50+ Perjalanan telah dilakukan melalui kami</p>
                </div>
            </div>
        </div>
    </div>
</section>