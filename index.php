<?php
include_once('classes/Database.php');
include_once('controllers/UserController.php');
include_once('controllers/DoctorController.php');
include_once('controllers/AppointmentController.php');

$database = new Database();
$database->initializeDatabase();
// $conn = $database->getConnection();

$userHandler = new UserController($database);
$doctorHandler = new DoctorController($database);
$appointmentHandler = new AppointmentController($database);

// $userHandler->createUser("john_doe", "john.doe@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "user");
// $doctorHandler->createDoctor("Dr. Smith", "Cardiologist");
// $appointmentHandler->createAppointment(1, 1, "2024-01-27 14:00:00");


$userHandler->createUser("Amanda", "amanda", "amanda@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "admin");

$userHandler->createUser("Nicole", "nicole", "nicole@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "user");

// Use the user ID to create a doctor associated with that user
$doctorHandler->createDoctor("Elena", "elena", "elena@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "doctor", "cardiologist");

?>