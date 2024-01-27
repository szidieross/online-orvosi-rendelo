<?php

class DoctorController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createDoctor($name, $specialty) {
        // A Doctor objektum létrehozása és adatbázisba való mentése
        $doctor = new Doctor($this->pdo);
        $doctor->create($name, $specialty);

        // Egyéb teendők, pl. visszajelzések, stb.
        echo "Az orvos sikeresen létrehozva!";
    }
}
