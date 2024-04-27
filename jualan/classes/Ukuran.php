<?php

class Ukuran extends DB
{
    function getUkuran()
    {
        $query = "SELECT * FROM ukuran";
        return $this->execute($query);
    }

    function getUkuranById($id)
    {
        $query = "SELECT * FROM ukuran WHERE id_ukuran=$id";
        return $this->execute($query);
    }

    function addUkuran($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO ukuran VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateUkuran($id, $data)
    {
        // ...
    }

    function deleteUkuran($id)
    {
        // ...
    }
}
