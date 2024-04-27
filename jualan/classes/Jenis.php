<?php

class Jenis extends DB
{
    function getJenisJoin()
    {
        $query = "SELECT * FROM jenis JOIN ukuran ON jenis.id_ukuran=ukuran.id_ukuran JOIN harga ON jenis.id_harga=harga.id_harga ORDER BY jenis.id_jenis";

        return $this->execute($query);
    }

    function getJenis()
    {
        $query = "SELECT * FROM jenis";
        return $this->execute($query);
    }

    function getJenisById($id)
    {
        $query = "SELECT * FROM jenis JOIN ukuran ON jenis.id_ukuran=ukuran.id_ukuran JOIN harga ON jenis.id_harga=harga.id_harga WHERE id_jenis=$id";
        return $this->execute($query);
    }

    function searchJenis($keyword)
    {
        // ...
    }

    function addData($data, $file)
    {
        // ...
    }

    function updateData($id, $data, $file)
    {
        // ...
    }

    function deleteData($id)
    {
        // ...
    }
}
