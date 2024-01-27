<?php
include_once('classes/Doctor.php');

class DoctorController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createDoctor($firstName, $lastName, $username, $email, $password, $role, $specialty)
    {
        $userHandler = new UserController($this->pdo);
        $userId = $userHandler->createUser($firstName, $lastName, $username, $email, $password, $role);
        $doctor = new Doctor($this->pdo);
        $doctor->create($userId, $firstName, $lastName, $specialty);

        echo "Az orvos sikeresen létrehozva!";
    }

    public function getAllDoctors()
    {
        $doctor = new Doctor($this->pdo);
        $doctors = $doctor->getAllDoctors();
        // echo "<pre>";
        // var_dump($doctors);
        return $doctors;
    }
}
