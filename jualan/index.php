<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Ukuran.php');
include('classes/Harga.php');
include('classes/Jenis.php');
include('classes/Template.php');

// buat instance jenis
$listJenis = new Jenis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listJenis->open();
// tampilkan data jenis
$listJenis->getJenisJoin();

// cari jenis
if (isset($_POST['btn-cari'])) {
    // methode mencari data jenis
    $listJenis->searchJenis($_POST['cari']);
} else {
    // method menampilkan data jenis
    $listJenis->getJenisJoin();
}

$data = null;

// ambil data jenis
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listJenis->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 jenis-thumbnail">
        <a href="detail.php?id=' . $row['id_jenis'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['foto_jenis'] . '" class="card-img-top" alt="' . $row['foto_jenis'] . '">
            </div>
            <div class="card-body">
                <p class="card-text jenis-nama my-0">' . $row['nama_jenis'] . '</p>
                <p class="card-text ukuran-nama">' . $row['nama_ukuran'] . '</p>
                <p class="card-text harga-nama my-0">' . $row['jum_harga'] . '</p>
            </div>
        </a>
    </div>    
    </div>
    <div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 jenis-thumbnail">
        <a href="detail.php?id=' . $row['id_jenis'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['foto_jenis'] . '" class="card-img-top" alt="' . $row['foto_jenis'] . '">
            </div>
            <div class="card-body">
                <p class="card-text jenis-nama my-0">' . $row['nama_jenis'] . '</p>
                <p class="card-text ukuran-nama">' . $row['nama_ukuran'] . '</p>
                <p class="card-text harga-nama my-0">' . $row['jum_harga'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listJenis->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_JENIS', $data);
$home->write();
