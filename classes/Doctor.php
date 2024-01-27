<?php

class Doctor {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($name, $specialty) {
        $connection = $this->db->getConnection();
        $stmt = $connection->prepare("INSERT INTO doctors (name, specialty) VALUES (?, ?)");
        $stmt->execute([$name, $specialty]);
    }
}
