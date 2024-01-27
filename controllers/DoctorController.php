<?php
include_once('classes/Doctor.php');

class DoctorController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createDoctor($name, $username, $email, $password, $role, $specialty)
    {
        $userHandler = new UserController($this->pdo);
        $userId = $userHandler->createUser($name, $username, $email, $password, $role);
        $doctor = new Doctor($this->pdo);
        $doctor->create($userId, $name, $specialty);

        echo "Az orvos sikeresen létrehozva!";
    }
}
