<?php
define('SCHEMA_PATH', 'C:/xampp/htdocs/2023/php/projekt/online-orvosi-rendelo/config.sql');

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "online_orvosi_rendelo";
    private $conn;

    public function initializeDatabase()
    {
        $conn = new mysqli($this->host, $this->username, $this->password);

        $sql = "CREATE DATABASE IF NOT EXISTS $this->database";

        if ($conn->query($sql) === false) {
            die("Hiba az adatbázis ($this->database) létrehozásában");
        }

        $conn->select_db($this->database);

        $config = file_get_contents(SCHEMA_PATH);

        if ($conn->multi_query($config)) {
            do {
            } while ($conn->next_result());
            echo "Adatbázis sikeresen inicializálva!";
        } else {
            die("Hiba az adatbázis inicializálása során: " . $conn->error);
        }
    }

    public function getConnection()
    {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($conn->connect_error) {
            die("Failed to connect to database: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>
