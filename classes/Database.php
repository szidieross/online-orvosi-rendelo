<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "online_orvosi_rendelo";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Beolvassuk a config.sql fájlt és lefuttatjuk az SQL kódot
            $sql = file_get_contents('config.sql');
            $this->conn->exec($sql);

            echo "Adatbázis sikeresen inicializálva!";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
