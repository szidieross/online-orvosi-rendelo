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

    }

    public function updateUserData($firstName, $lastName, $username, $email, $userId)
    {
        $conn = $this->db->getConnection();

        $sql = "UPDATE users SET first_name=?, last_name=?, username=?, email=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssssi", $firstName, $lastName, $username, $email, $userId);

        if (!$stmt->execute()) {
            die("Hiba az adat frissítése során: " . $stmt->error);
        }

        $_SESSION["username"] = $username;
        echo "Changes saved.";
        $stmt->close();
    }
}
?>