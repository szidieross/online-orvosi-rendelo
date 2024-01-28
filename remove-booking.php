<?php
include_once("./controllers/UserController.php");
include_once("./controllers/DoctorController.php");
include_once("./controllers/AppointmentController.php");
include_once("./classes/Database.php");

$database = Database::getInstance();

$currentUsername = $_SESSION["username"];
$userHandler = new UserController($database);
$userData = $userHandler->getUserData($currentUsername);

$appointmentHandler = new AppointmentController($database);
$appointments = $appointmentHandler->getAppointmentByUserId($userData["user_id"]);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["remove"])) {
    $id = $_POST["appointment_id"];
    $appointmentHandler->removeAppointmentById($id);
}