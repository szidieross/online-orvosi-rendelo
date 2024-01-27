<?php
include('classes/Database.php');
include('controllers/UserController.php');
include('controllers/DoctorController.php');
include('controllers/AppointmentController.php');

$database = new Database();
$database->initializeDatabase();
// $conn = $database->getConnection();

$userHandler = new UserController($database);
// $doctorHandler = new DoctorController($database);
$appointmentHandler = new AppointmentController($database);

// $userHandler->createUser("john_doe", "john.doe@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "user");
// $doctorHandler->createDoctor("Dr. Smith", "Cardiologist");
// $appointmentHandler->createAppointment(1, 1, "2024-01-27 14:00:00");

$userHandler->createUser("elena", "elena@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "doctor");

$userHandler->createUser("amanda", "amanda@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "user");

// Use the user ID to create a doctor associated with that user
// $doctorHandler->createDoctor($userId, "John Doe", "Cardiologist");

?>