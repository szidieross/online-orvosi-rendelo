<?php

class Doctor
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($userId, $name, $specialty)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO doctors (user_id,name, specialty) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $name, $specialty]);
    }
}
