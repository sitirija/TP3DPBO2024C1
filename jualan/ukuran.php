<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Ukuran.php');
include('classes/Template.php');

$ukuran = new Ukuran($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$ukuran->open();
$ukuran->getUkuran();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($ukuran->addUkuran($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'ukuran.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'ukuran.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Ukuran';
$header = '<tr>
<th scope="row">No</th>
<th scope="row">Ukuran</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'ukuran';

while ($div = $ukuran->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_ukuran'] . '</td>
    <td style="font-size: 22px;">
        <a href="ukuran.php?id=' . $div['id_ukuran'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="ukuran.php?hapus=' . $div['id_ukuran'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($ukuran->updateUkuran($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'ukuran.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'ukuran.php';
            </script>";
            }
        }

        $ukuran->getUkuranById($id);
        $row = $ukuran->getResult();

        $dataUpdate = $row['nama_ukuran'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }

    // Formulir untuk menambahkan data baru
    $dataForm = '<form method="post">
        <div class="mb-3">
            <label for="nama_ukuran" class="form-label">Nama Ukuran</label>
            <input type="text" class="form-control" id="nama_ukuran" name="nama_ukuran">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </form>';

    // Ganti 'DATA_FORM' pada template dengan formulir yang baru
    $view->replace('DATA_FORM', $dataForm);
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($ukuran->deleteUkuran($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'ukuran.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'ukuran.php';
            </script>";
        }
    }
}

$ukuran->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
