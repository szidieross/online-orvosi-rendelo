<?php

class Doctor
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($userId, $firstName, $lastName, $specialty)
    {
        $conn = $this->db->getConnection();

        $stmt = $conn->prepare("INSERT INTO doctors (user_id, first_name, last_name, specialty) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $firstName, $lastName, $specialty]);
    }
}
