<?php

class Mahasiswa_model
{
    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function getAllMahasiswa()
    {
        // untuk mengambil semua data
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getMahasiswaById($id)
    {
        // untuk mengambil data berdasarkan id
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');

        // untuk menghindari sql injection
        $this->db->bind('id', $id);

        return $this->db->single();
    }
}
