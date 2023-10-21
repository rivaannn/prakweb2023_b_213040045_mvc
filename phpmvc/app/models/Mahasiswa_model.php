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

    public function tambahDataMahasiswa($data)
    {
        $query = "INSERT INTO mahasiswa (nama, nrp, email, jurusan) VALUES (:nama, :nrp, :email, :jurusan)";


        $this->db->query($query);
        // untuk menghindari sql injection
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        // mengembalikan nilai 1 jika berhasil dan -1 jika gagal
        return $this->db->rowCount();
    }
}
