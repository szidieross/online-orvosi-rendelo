<?php
include('classes/Doctor.php');

class DoctorController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createDoctor($userId, $name, $specialty)
    {
        $doctor = new Doctor($this->pdo);
        $doctor->create($userId, $name, $specialty);

        echo "Az orvos sikeresen létrehozva!";
    }
}
