<?php

include_once('classes/Appointment.php');

class AppointmentController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createAppointment($userId, $doctorId, $appointmentTime)
    {
        $appointment = new Appointment($this->pdo);
        $appointment->create($userId, $doctorId, $appointmentTime);

        echo "Az időpont sikeresen létrehozva!";
    }

    public function getAllAppointments()
    {
        $appointment = new Appointment($this->pdo);
        $appointment->getAllAppointments();
    }

    public function getAppointmentByDoctorId($doctorId)
    {
        $appointment = new Appointment($this->pdo);
        $selectedAppointments = $appointment->getAppointmentByDoctorId($doctorId);
        return $selectedAppointments;
    }

    public function getBookedAppointmentByDoctorId($doctorId)
    {
        $appointment = new Appointment($this->pdo);
        $selectedAppointments = $appointment->getBookedAppointmentByDoctorId($doctorId);
        return $selectedAppointments;
    }

    public function getAppointmentByUserId($userId)
    {
        $appointment = new Appointment($this->pdo);
        $selectedAppointments = $appointment->getAppointmentByUserId($userId);
        return $selectedAppointments;
    }

    public function book($userId, $id)
    {
        $appointment = new Appointment($this->pdo);
        $appointment->book($userId, $id);
    }

    public function isAppointmentBooked($id)
    {
        $appointment = new Appointment($this->pdo);
        $isBooked = $appointment->isAppointmentBooked($id);
        return $isBooked;
    }

    public function deleteAppointmentById($id)
    {
        $appointment = new Appointment($this->pdo);
        $appointment->deleteAppointmentById($id);
    }

    public function removeAppointmentById($id)
    {
        $appointment = new Appointment($this->pdo);
        $appointment->removeAppointmentById($id);
    }
}
?>