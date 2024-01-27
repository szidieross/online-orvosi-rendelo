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
        $stmt->bind_param("isss", $userId, $firstName, $lastName, $specialty);

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }

    public function getAllDoctors()
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM doctors INNER JOIN users ON doctors.user_id = users.user_id");
        $stmt->execute();

        $result = $stmt->get_result();
        $doctors = array();

        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row;
        }
        // echo "<pre>";
        // var_dump($doctors);

        return $doctors;
    }
}
