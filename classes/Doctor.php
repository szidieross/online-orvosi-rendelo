<?php

class Doctor {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($name, $specialty) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO doctors (name, specialty) VALUES (?, ?)");
        $stmt->execute([$name, $specialty]);
    }
}
