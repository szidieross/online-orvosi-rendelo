<?php

class Appointment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($userId, $doctorId, $appointmentTime) {
        $connection = $this->db->getConnection();
        $stmt = $connection->prepare("INSERT INTO appointments (user_id, doctor_id, appointment_time) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $doctorId, $appointmentTime]);
    }
}