<?php
include("classes/User.php");
class UserController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUser($username, $email, $password, $role)
    {
        $user = new User($this->db);
        $userId = $user->create($username, $email, $password, $role);

        if ($role == 'doctor') {

            $doctorHandler = new DoctorController($this->db);
            $doctorHandler->createDoctor($userId, "John Doe", "Cardiologist");
        }

        echo "A felhasználó sikeresen létrehozva!: " . $userId;
    }
}
?>