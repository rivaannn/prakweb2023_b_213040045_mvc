<?php

class Mahasiswa_model
{
    // private $mhs = [
    // //     [
    // //         "nama" => "Rivan",
    // //         "nrp" => "213040045",
    // //         "email" => "mrivans2002@gmail.com",
    // //         "jurusan" => "Teknik Informatika"
    // //     ],
    // //     [
    // //         "nama" => "Ammmar",
    // //         "nrp" => "213040051",
    // //         "email" => "ammmarbahtiar@gmail.com",
    // //         "jurusan" => "Teknik Informatika"
    // //     ],
    // //     [
    // //         "nama" => "Ardhi",
    // //         "nrp" => "213040068",
    // //         "email" => "ardhi@gmail.com",
    // //         "jurusan" => "Teknik Informatika"
    // //     ]
    // // ];

    private $dbh; // database handler
    private $stmt;

    public function __construct()
    {
        // data source name
        $dsn = 'mysql:host=localhost;dbname=prakweb2023_b_213040045_mvc';

        try {
            $this->dbh = new PDO($dsn, 'root', '');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllMahasiswa()
    {
        $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
