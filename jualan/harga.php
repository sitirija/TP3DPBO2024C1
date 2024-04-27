<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Harga.php');
include('classes/Template.php');

$harga = new Harga($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$harga->open();
$harga->getHarga();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($harga->addHarga($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'harga.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'harga.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Harga';
$header = '<tr>
<th scope="row">No</th>
<th scope="row">Harga</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'harga';

while ($div = $harga->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_harga'] . '</td>
    <td style="font-size: 22px;">
        <a href="harga.php?id=' . $div['id_harga'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="harga.php?hapus=' . $div['id_harga'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($harga->updateHarga($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'harga.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'harga.php';
            </script>";
            }
        }

        $harga->getHargaById($id);
        $row = $harga->getResult();

        $dataUpdate = $row['nama_harga'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($harga->deleteHarga($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'harga.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'harga.php';
            </script>";
        }
    }
}

$harga->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
