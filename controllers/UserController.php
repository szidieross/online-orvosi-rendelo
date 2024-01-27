<?php
include_once('classes/User.php');
include_once('DoctorController.php');
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

    public function loginUser($username, $password)
    {

        $user = new User($this->db);
        $user->loginUser($username, $password);
    }

    public function getUserData($username)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return null;
        }
    }

    public function getUserDataById($userId)
    {
        $conn = $this->db->getConnection();
        // $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        // $stmt->bind_param("s", $userId);
        // $stmt->execute();

        // $result = $stmt->get_result();

        // if ($result->num_rows > 0) {
        //     $user = $result->fetch_assoc();
        //     return $user;
        // } else {
        //     return null;
        // }

        echo "ID" . $userId;

        $sql = "SELECT nev, atlag, szak from hallgatok WHERE id=?";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Hiba a SELECT lekérdezés előkészítése során: " . $conn->error);
        }

        $stmt->bind_param("i", $userId);

        if (!$stmt->execute()) {
            die("Hiba a SELECT lekérdezés során: " . $conn->error);
        }

        $stmt->bind_result($nev, $atlag, $szak);

        $stmt->fetch();
        $stmt->close();
    }

    public function updateUserData($userId)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT nev, atlag, szak from hallgatok WHERE id=?";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Hiba a SELECT lekérdezés előkészítése során: " . $conn->error);
        }

        $stmt->bind_param("i", $userId);

        if (!$stmt->execute()) {
            die("Hiba a SELECT lekérdezés során: " . $conn->error);
        }

        // $stmt->bind_result($nev, $atlag, $szak);

        $stmt->fetch();
        $stmt->close();

        // $conn = $this->db->getConnection();
        // $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        // $stmt->bind_param("s", $userId);
        // $stmt->execute();

        // $result = $stmt->get_result();

        // if ($result->num_rows > 0) {
        //     $user = $result->fetch_assoc();
        //     return $user;
        // } else {
        //     return null;
        // }
    }
}
?>