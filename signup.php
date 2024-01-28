<?php
include_once('classes/Database.php');
include_once('controllers/UserController.php');
include_once('controllers/DoctorController.php');
$database = Database::getInstance();

if (isset($_SESSION["username"])) {
    header("Location: index.php");
}

if (isset($_POST["sign_up"]) && $_SERVER['REQUEST_METHOD'] === "POST") {

    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $rawPassword = $_POST["password"];
    $password = password_hash($rawPassword, PASSWORD_DEFAULT);
    $role = $_POST["role"];
    $specialty = $_POST["specialty"];

    $userHandler = new UserController($database);
    $doctorHandler = new DoctorController($database);

    $userExists = $userHandler->getUserData($username);
    if ($userExists) {
        echo "A felhasznalonev mar letezik, kerem valasszon masikat!";
    } else if ($role == "doctor") {
        $doctorHandler->createDoctor($firstName, $lastName, $username, $email, $password, $role, $specialty);
    } else {
        $userHandler->createUser($firstName, $lastName, $username, $email, $password, $role);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <p>Van fiokod?</p>
    <a href="login.php">
        <button class="button">Jelentkezz be</button></a>
    <h2>Regisztralj</h2>

    <form method="POST" action="">
        First Name: <input type="text" name="first_name" id="" required><br><br>
        Last Name: <input type="text" name="last_name" id="" required><br><br>
        Username: <input type="text" name="username" id="" required><br><br>
        Email: <input type="email" name="email" id="" required><br><br>
        Password: <input type="password" name="password" id="" required><br><br>
        Confirm Password: <input type="password" name="confirmPassword" id="" required><br><br>
        Role:
        <select name="role" id="role" required>
            <option value="user">User</option>
            <option value="doctor">Doctor</option>
        </select><br><br>
        <p>if you're a doctor:</p><br />
        Specialty: <input type="text" name="specialty" id=""><br><br>
        <input type="submit" name="sign_up" class="button" value="Sign Up">
    </form>
    <p>Already have an account? <a href="login.php"> <button class="button">Sign in</button></a></p>
</body>

</html>