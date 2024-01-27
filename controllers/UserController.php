<?php
include_once("classes/User.php");
include_once('controllers/DoctorController.php');
class UserController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUser($name, $username, $email, $password, $role)
    {
        $user = new User($this->db);
        $userId = $user->create($name, $username, $email, $password, $role);

        echo "A felhasználó sikeresen létrehozva!: " . $userId;
        return $userId;
    }
}
?>