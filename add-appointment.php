<?php
session_start();
include_once("controllers/Appointment.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION["doctor"])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $appointmentHandler = new AppointmentController();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <h2>Add Appointment</h2>
    <form action="" method="post">
        <label for="doctor">Select Doctor:</label>
        <!-- <select name="doctor" id="doctor" required>
            <option value="doctor1">Doctor 1</option>
            <option value="doctor2">Doctor 2</option>
        </select> -->

        <label for="appointmentDate">Select Date:</label>
        <input type="date" name="appointmentDate" id="appointmentDate" required>

        <label for="appointmentTime">Select Time:</label>
        <input type="time" name="appointmentTime" id="appointmentTime" required>

        <input type="submit" name="submit" value="Submit Appointment">
    </form>
    <p><a href="index.php">Back to Home</a></p>
</body>

</html>