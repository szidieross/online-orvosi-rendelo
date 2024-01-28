<?php
session_start();
include_once('classes/Database.php');
include_once('controllers/UserController.php');
include_once('controllers/DoctorController.php');
$database = Database::getInstance();

if (isset($_SESSION["username"])) {
    header("Location: index.php");
}

if (isset($_POST["login"]) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $userHandler = new UserController($database);
    $userHandler->loginUser($username, $password);
}

if (isset($_POST["doctor_login"]) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $doctorHandler = new DoctorController($database);
    $doctorHandler->doctorLogin($username, $password);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <div class="toggle-container">
        <button onclick="toggleForm('user')">Login as User</button>
        <button onclick="toggleForm('doctor')">Login as Doctor</button>
    </div>

    <div class="main-container">
        <div class="form" id="user-form">
            <h2>Login as a User</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="login" class="btn" value="Login">
                </div>
            </form>
            <p>Don't have an account? <a href="signup.php"> <button class="btn">Sign up</button></a></p>
        </div>

        <div class="form" id="doctor-form" style="display:none;">
            <h2>Login as a Doctor</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="doctor_login" class="btn" value="Login">
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleForm(formType) {
            if (formType === 'user') {
                document.getElementById('user-form').style.display = 'block';
                document.getElementById('doctor-form').style.display = 'none';
            } else if (formType === 'doctor') {
                document.getElementById('user-form').style.display = 'none';
                document.getElementById('doctor-form').style.display = 'block';
            }
        }
    </script>
</body>

</html>