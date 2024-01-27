<?php

include_once('classes/Appointment.php');

class AppointmentController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createAppointment($userId, $doctorId, $appointmentTime) {
        $appointment = new Appointment($this->pdo);
        $appointment->create($userId, $doctorId, $appointmentTime);

        echo "Az időpont sikeresen létrehozva!";
    }
}
?>
