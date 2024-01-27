<?php
session_start();
class User
{
    private Database $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($firstName, $lastName, $username, $email, $password, $role)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstName, $lastName, $username, $email, $hashedPassword, $role);

        if ($stmt->execute()) {
            $userId = $conn->insert_id;
            return $userId;
        } else {
            echo "Hiba a felhasználó létrehozása során: " . $stmt->error;
            return false;
        }
    }

    public function loginUser($username, $password) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION["username"]=$username;
                echo "Sikeres bejelentkezés";
            } else {
                echo "Érvénytelen jelszó";
            }
        } else {
            echo "Felhasználó nem található";
        }
    }
}
?>