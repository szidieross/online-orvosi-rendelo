<?php

class Doctor
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($userId, $firstName, $lastName, $specialty)
    {
        $conn = $this->db->getConnection();

        $stmt = $conn->prepare("INSERT INTO doctors (user_id, first_name, last_name, specialty) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userId, $firstName, $lastName, $specialty);

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }

    public function getAllDoctors()
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM doctors INNER JOIN users ON doctors.user_id = users.user_id");
        $stmt->execute();

        $result = $stmt->get_result();
        $doctors = array();

        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row;
        }
        // echo "<pre>";
        // var_dump($doctors);

        return $doctors;
    }

    public function doctorLogin($username, $password)
    {
        echo "hello";
        $conn = $this->db->getConnection();
        $sql = "SELECT username, password FROM users
                INNER JOIN doctors ON doctors.user_id = users.user_id
                WHERE username = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $conn->error);
        }

        $stmt->bind_param("s", $username);

        if (!$stmt->execute()) {
            die("Error executing query: " . $conn->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                echo "Successful doctor login";
                $_SESSION["username"] = $username;
                header("Location: index.php"); // Redirect to the doctor's dashboard
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "Username not found.";
        }
    }
}
