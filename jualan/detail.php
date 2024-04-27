<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Ukuran.php');
include('classes/Harga.php');
include('classes/Jenis.php');
include('classes/Template.php');

$jenis = new jenis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jenis->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $jenis->getjenisById($id);
        $row = $jenis->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama_jenis'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto_jenis'] . '" class="img-thumbnail" alt="' . $row['foto_jenis'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Jenis</td>
                                    <td>:</td>
                                    <td>' . $row['nama_jenis'] . '</td>
                                </tr>
                                <tr>
                                    <td>Ukuran</td>
                                    <td>:</td>
                                    <td>' . $row['nama_ukuran'] . '</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>' . $row['jum_harga'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="#"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="#"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$jenis->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_JENIS', $data);
$detail->write();
