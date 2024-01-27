<?php
include_once('classes/Database.php');
include_once('controllers/UserController.php');
$database = Database::getInstance();

if (isset($_POST["sign_up"]) && $_SERVER['REQUEST_METHOD'] === "POST") {

    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    if ($_POST["password"] == $_POST["confirmPassword"]) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    } else {
        echo "jelszo nem jo";
    }
    $role = $_POST["role"];

    $userHandler = new UserController($database);

    $userHandler->createUser($firstName, $lastName, $username, $email, $password, $role);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <p>Van fiokod?</p>
    <a href="login.php">
        <button>Jelentkezz be</button></a>
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
            <option value="admin">Admin</option>
        </select><br><br>
        <input type="submit" name="sign_up" value="Sign Up">
    </form>
    <p>Already have an account? <a href="login.php"> <button class="btn">Sign in</button></a></p>
</body>

</html>