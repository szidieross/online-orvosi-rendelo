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

    public function createUser($firstName, $lastName, $username, $email, $password, $role)
    {
        $user = new User($this->db);
        $userId = $user->create($firstName, $lastName, $username, $email, $password, $role);

        echo "A felhasználó sikeresen létrehozva!: " . $userId;
        return $userId;
    }

    public function loginUser($username, $password) {
        
        $user = new User($this->db);
        $user->loginUser($username, $password);
    }
}
?>