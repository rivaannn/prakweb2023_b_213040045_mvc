<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh; // database handler
    private $stmt;

    public function __construct()
    {
        // data source name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        // optimasi database
        $option = [
            PDO::ATTR_PERSISTENT => true, // untuk membuat koneksi terjaga terus
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // untuk menampilkan error
        ];

        try {
            // untuk menghubungkan database
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            // jika terjadi error
            die($e->getMessage());
        }
    }

    public function query($query)
    {
        // untuk menyiapkan query
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        // untuk menghindari sql injection
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    // jika valuenya integer
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    // jika valuenya boolean
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    // jika valuenya null
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    // jika valuenya string
                    $type = PDO::PARAM_STR;
            }
        }

        // untuk mengikat nilai
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        // untuk mengeksekusi query
        $this->stmt->execute();
    }

    public function resultSet()
    {
        // untuk mengambil semua data
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        // untuk mengambil satu data
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        // untuk menghitung baris yang ada di tabel
        return $this->stmt->rowCount();
    }
}
