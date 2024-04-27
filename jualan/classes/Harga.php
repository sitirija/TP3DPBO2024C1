<?php

class Harga extends DB
{
    function getHarga()
    {
        $query = "SELECT * FROM harga";
        return $this->execute($query);
    }

    function getHargaById($id)
    {
        $query = "SELECT * FROM harga WHERE id_harga=$id";
        return $this->execute($query);
    }

    function addHarga($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO ukuran VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateHarga($id, $data)
    {
        // ...
    }

    function deleteHarga($id)
    {
        // ...
    }
}
