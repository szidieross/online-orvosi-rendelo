<?php

class AppointmentController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createAppointment($userId, $doctorId, $appointmentTime) {
        // Az Appointment objektum létrehozása és adatbázisba való mentése
        $appointment = new Appointment($this->pdo);
        $appointment->create($userId, $doctorId, $appointmentTime);

        // Egyéb teendők, pl. visszajelzések, stb.
        echo "Az időpont sikeresen létrehozva!";
    }
}
?>
