<?php

class Appointment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($userId, $doctorId, $appointmentTime) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO appointments (user_id, doctor_id, appointment_time) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $doctorId, $appointmentTime]);
    }
}