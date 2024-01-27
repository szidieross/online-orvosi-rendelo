<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "online_orvosi_rendelo";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->createDatabaseIfNotExists();
            $this->conn->exec("USE $this->database");

            $sql = file_get_contents('config.sql');
            $this->conn->exec($sql);

            echo "Adatbázis sikeresen inicializálva!";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    private function createDatabaseIfNotExists()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->database";
        $this->conn->exec($sql);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}