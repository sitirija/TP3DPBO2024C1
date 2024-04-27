<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Ukuran.php');
include('classes/Harga.php');
include('classes/Jenis.php');
include('classes/Template.php');

// buat instance jenis
$jenis = new Jenis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jenis->open();

$ukuran = new Ukuran($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$ukuran->open();
$ukuran->getUkuran();

$harga = new Harga($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$harga->open();
$harga->getHarga();

if (isset($_POST['btn-simpan'])) {
    $data = [
        'fileNameFoto' => $_POST['fileNameFoto']['name'],
        'nama' => $_POST['jenis'],
        'id_ukuran' => $_POST['ukuran'],
        'id_harga' => $_POST['harga']
    ];

    $file = $_FILES['fotoToUpload'];

    $result = $jenis->addData($data, $file);

    if ($result > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo '<script>alert("Data gagal ditambahkan!");</script>';
    }
}

$ukuranData = null;
$hargaData = null;

while ($div = $ukuran->getResult()) {
    $ukuranData .= '<option value="' . $div['id_ukuran'] . '">' . $div['nama_ukuran'] . '</option>';
}

while ($jab = $harga->getResult()) {
    $hargaData .= '<option value="' . $jab['id_harga'] . '">' . $jab['jum_harga'] . '</option>';
}

$view = new Template('templates/skinform.html');

$view->replace('DATA_UKURAN', $ukuranData);
$view->replace('DATA_HARGA', $hargaData);
$view->replace('DATA_BUTTON', "Tambah");

$view->write();