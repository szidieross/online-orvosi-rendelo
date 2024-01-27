<?php

require_once 'classes/Database.php';

$database = new Database();
$pdo = $database->getConnection();

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

$userHandler = new UserController($pdo);
$doctorHandler = new DoctorController($pdo);
$appointmentHandler = new AppointmentController($pdo);

$userHandler->createUser("john_doe", "john.doe@example.com", password_hash("secret_password", PASSWORD_DEFAULT));

$doctorHandler->createDoctor("Dr. Smith", "Cardiologist");

$appointmentHandler->createAppointment(1, 1, "2024-01-27 14:00:00");
?>
