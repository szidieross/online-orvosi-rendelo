<?php
define('SCHEMA_PATH', 'C:/xampp/htdocs/2023/php/projekt/online-orvosi-rendelo/config.sql');

class Database
{
    private static $instance;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "online_orvosi_rendelo";
    private $conn;

    private function __construct()
    {
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance=new self();
            self::$instance->initializeDatabase();
        }
        return self::$instance;
    }

    private function initializeDatabase()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password);

        $sql = "CREATE DATABASE IF NOT EXISTS $this->database";

        if ($this->conn->query($sql) === false) {
            die("Hiba az adatbázis ($this->database) létrehozásában");
        }

        $this->conn->select_db($this->database);

        $config = file_get_contents(SCHEMA_PATH);

        if ($this->conn->multi_query($config)) {
            do {
            } while ($this->conn->next_result());
            echo "Adatbázis sikeresen inicializálva!";
        } else {
            die("Hiba az adatbázis inicializálása során: " . $this->conn->error);
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