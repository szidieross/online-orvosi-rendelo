<?php

class Appointment
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($userId, $doctorId, $appointmentTime)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO appointments (user_id, doctor_id, appointment_time) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $doctorId, $appointmentTime]);
    }

    public function getAllAppointments()
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM appointments";
        $stmt = $conn->prepare($sql);
        if ($stmt == false) {
            echo "Hiba lekerdezes elokeszitesenel" . $conn->error;
        }
        if (!$stmt->execute()) {
            echo "Hiba lekerdezeskor" . $stmt->error;
        }
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $appointments = $result->fetch_assoc();
            return $appointments;
        }
        return null;
    }

    public function getAppointmentByDoctorId($doctorId)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM appointments WHERE doctor_id=? AND user_id IS null";
        $stmt = $conn->prepare($sql);
        if ($stmt == false) {
            echo "Hiba lekerdezes elokeszitesenel" . $conn->error;
        }
        $stmt->bind_param("i", $doctorId);
        if (!$stmt->execute()) {
            echo "Hiba lekerdezeskor" . $stmt->error;
        }
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $selectedAppointments = $result->fetch_all(MYSQLI_ASSOC);
            return $selectedAppointments;
        }
        return null;
    }


    public function book($userId, $id)
    {
        $conn = $this->db->getConnection();
        $sql = "UPDATE appointments SET user_id=? WHERE appointment_id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt == false) {
            echo "Hiba lekerdezes elokeszitesenel" . $conn->error;
        }
        $stmt->bind_param("ii", $userId, $id);
        if (!$stmt->execute()) {
            echo "Hiba lekerdezeskor" . $stmt->error;
        }
        $stmt->close();
    }
}