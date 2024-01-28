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

    public function doctorLogin($username, $password)
    {
        $doctor = new Doctor($this->pdo);
        $doctor->doctorLogin($username, $password);
    }

    public function updateDoctorData($firstName, $lastName, $userId)
    {
        $conn = $this->pdo->getConnection();

        $sql = "UPDATE doctors SET first_name=?, last_name=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssi", $firstName, $lastName, $userId);

        if (!$stmt->execute()) {
            die("Hiba az adat frissítése során: " . $stmt->error);
        }

        $stmt->close();

        header("Location: index.php");
    }

    public function getDoctorById($doctorId)
    {
        $conn = $this->pdo->getConnection();

        $sql = "SELECT * FROM doctors WHERE doctor_id=?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("i", $doctorId);

        if (!$stmt->execute()) {
            die("Hiba az adat frissítése során: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $stmt->close();
      
        if($result->num_rows>0){
            $doctor=$result->fetch_assoc();
            return $doctor;
        }
        return null;
    }
}
