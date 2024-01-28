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
        $sql = "SELECT * FROM appointments WHERE doctor_id=? AND user_id IS NULL";
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

    public function getBookedAppointmentByDoctorId($doctorId)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT appointments.*, users.* FROM appointments INNER JOIN users ON users.user_id=appointments.user_id WHERE doctor_id=?";
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

    public function getAppointmentByUserId($userId)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT appointments.*, doctors.* FROM appointments INNER JOIN doctors ON appointments.doctor_id=doctors.doctor_id WHERE appointments.user_id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt == false) {
            echo "Hiba lekerdezes elokeszitesenel" . $conn->error;
        }
        $stmt->bind_param("i", $userId);
        if (!$stmt->execute()) {
            echo "Hiba lekerdezeskor" . $stmt->error;
        }
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
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

    public function isAppointmentBooked($id)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT user_id FROM appointments WHERE appointment_id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt == false) {
            echo "Hiba lekerdezes elokeszitesenel" . $conn->error;
        }
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "Hiba lekerdezeskor" . $stmt->error;
        }
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $isBooked = $result->fetch_assoc();
            return $isBooked;
        }
        return null;
    }

    public function deleteAppointmentById($id)
    {
        $conn = $this->db->getConnection();
        $sql = "DELETE FROM appointments WHERE appointment_id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt == false) {
            echo "Hiba lekerdezes elokeszitesenel" . $conn->error;
        }
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "Hiba lekerdezeskor" . $stmt->error;
        }
        $stmt->close();
    }

    public function removeAppointmentById($id)
    {
        $conn = $this->db->getConnection();
        $sql = "UPDATE appointments SET user_id = NULL WHERE appointment_id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt == false) {
            echo "Hiba lekerdezes elokeszitesenel" . $conn->error;
        }
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "Hiba lekerdezeskor" . $stmt->error;
        }
        $stmt->close();
    }
}