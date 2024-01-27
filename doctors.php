<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

include_once("controllers/DoctorController.php");
include_once("./classes/Database.php");
$database = Database::getInstance();
$currentUsername = $_SESSION["username"];
$doctorHandler = new DoctorController($database);
$doctorData = $doctorHandler->getAllDoctors();
echo "<pre>";
var_dump($doctorData);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <td><a href="./logout.php"><button>Logout</button></a></td>

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
                <?php foreach ($doctorData as $doctor): ?>

                    <tr>
                        <td>
                            <?php echo $doctor["first_name"]; ?>
                        </td>
                        <td>
                            <?php echo $doctor["last_name"]; ?>
                        </td>
                        <td>
                            <?php echo $doctor["username"]; ?>
                        </td>
                        <td>
                            <?php echo $doctor["email"]; ?>
                        </td>
                        <td><a href="./booking.php?id=<?php echo $doctor["doctor_id"]; ?>">Szerkesztés</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
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