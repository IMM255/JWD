<?php
$dasbor = false;
$adminwisata = false;
$tambah = false;
$ubah = false;

if (isset($_GET['halaman'])) {
    $halaman = $_GET['halaman'];
    switch ($halaman) {
        case 'dasbor':
            $dasbor = true;
            break;
        case 'admin_wisata':
            $adminwisata = true;
            break;
        case 'tambah_wisata':
            $tambah = true;
            break;
        case 'ubah_wisata':
            $ubah = true;
            break;
        default:
            $dasbor = false;
            $adminwisata = false;
            $tambah = false;
            $ubah = false;
    }
} else {
    $dasbor = false;
    $adminwisata = false;
    $tambah = false;
    $ubah = false;
}

?>
<aside id="sidebar">
            <div class="d-flex">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-4 px-5 py-2">Travel - Admin</span>
                </a>
            </div>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="index.php?halaman=dasbor" class="nav-link text-white <?= $dasbor ? 'active' : '' ?>" aria-current="page">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#home"></use>
                        </svg>
                        Dasbor
                    </a>
                </li>
                <li>
                    <a href="index.php?halaman=admin_wisata" class="nav-link text-white  <?= $adminwisata || $tambah || $ubah ? 'active' : '' ?>">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Paket Travel
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Logout
                    </a>
                </li>
            </ul>
            <hr>
</aside>