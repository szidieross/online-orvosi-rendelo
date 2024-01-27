<?php
// include_once('classes/Database.php');
// include_once('controllers/UserController.php');
// include_once('controllers/DoctorController.php');
// include_once('controllers/AppointmentController.php');

// // $database = new Database();
// $database=Database::getInstance();
// // $conn = $database->getConnection();

// $userHandler = new UserController($database);
// $doctorHandler = new DoctorController($database);
// $appointmentHandler = new AppointmentController($database);

// // $userHandler->createUser("john_doe", "john.doe@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "user");
// // $doctorHandler->createDoctor("Dr. Smith", "Cardiologist");
// // $appointmentHandler->createAppointment(1, 1, "2024-01-27 14:00:00");


// $userHandler->createUser("Amanda", "Seyfried", "amanda", "amanda@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "admin");

// $userHandler->createUser("Nicole", "Wallace", "nicole", "nicole@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "user");

// // Use the user ID to create a doctor associated with that user
// $doctorHandler->createDoctor("Mia", "Torreto", "mia", "mia@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "doctor", "cardiologist");


session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/styles/general.css">
</head>

<body>
    <form action="" method="POST" class="">
        <input type="hidden" name="username" value="" />
        <button type="submit" name="logout" value="" class="btn">Log Out</button>
    </form>
    <div class="booking">
        <h2>Personal Data</h2>
        <table class="">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Settings</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
    <div class="booking">
        <h2>Want an Appointment?</h2>
        <button class="btn"><a href="./booking.php" class="btn">Book Appointment</a></p></button>
    </div>

    <div class="booking">
        <h2>Appointments</h2>

        <table class="appointments">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>pecialty</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                

            </tbody>
        </table>
    </div>
</body>

</html>