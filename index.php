<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

include_once("./controllers/UserController.php");
include_once("./controllers/DoctorController.php");
include_once("./controllers/AppointmentController.php");
include_once("./classes/Database.php");
include_once("./remove-booking.php");
include_once("./delete-booking.php");

$database = Database::getInstance();

$currentUsername = $_SESSION["username"];
$userHandler = new UserController($database);
$userData = $userHandler->getUserData($currentUsername);

$appointmentHandler = new AppointmentController($database);
$appointments = $appointmentHandler->getAppointmentByUserId($userData["user_id"]);

if (isset($_SESSION["doctor"])) {
    $doctorHandler = new DoctorController($database);
    $doctorData = $doctorHandler->getDoctorByUserId($userData["user_id"]);

    $appointmentsDoctors = $appointmentHandler->getBookedAppointmentByDoctorId($doctorData["doctor_id"]);
}

$userBoking = <<<EOD
<div class="booking">
    <h2>Want an Appointment?</h2>
    <a href="./doctors.php"><button class="button">Book Appointment</button></a>
</div>
EOD;

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
    <main>
        <td><a href="./logout.php"><button class="button">Logout</button></a></td>

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
                    <?php
                    ?>
                    <tr>
                        <td>
                            <?php echo $userData["first_name"]; ?>
                        </td>
                        <td>
                            <?php echo $userData["last_name"]; ?>
                        </td>
                        <td>
                            <?php echo $userData["username"]; ?>
                        </td>
                        <td>
                            <?php echo $userData["email"]; ?>
                        </td>
                        <td><a href="./updateUser.php?id=<?php echo $userData["user_id"]; ?>"><button class="button">Edit</button></a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php if (!isset($_SESSION["doctor"])) {
            echo $userBoking;
        }
        ?>

        <?php if (!isset($_SESSION["doctor"])): ?>

            <div class="booking">
                <h2>Appointments</h2>

                <table class="appointments">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Specialty</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($appointments): ?>
                            <?php foreach ($appointments as $data):
                                $dateTime = $data['appointment_time'];
                                $date = date("Y-m-d", strtotime($dateTime));
                                $time = date("H-m-s", strtotime($dateTime));
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $data["first_name"];
                                        echo $data["last_name"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $data["specialty"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $date; ?>
                                    </td>
                                    <td>
                                        <?php echo $time; ?>
                                    </td>
                                    <td>
                                        <form method="post" action="">
                                            <input type="hidden" name="appointment_id"
                                                value="<?php echo $data['appointment_id']; ?>">
                                            <button type="submit" class="button" name="remove">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">There are no bookings yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>

            <div class="booking">
                <h2>Appointments</h2>

                <table class="appointments">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($appointmentsDoctors): ?>
                            <?php foreach ($appointmentsDoctors as $data):
                                $dateTime = $data['appointment_time'];
                                $date = date("Y-m-d", strtotime($dateTime));
                                $time = date("H-m-s", strtotime($dateTime));
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $data["first_name"];
                                        echo $data["last_name"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $date; ?>
                                    </td>
                                    <td>
                                        <?php echo $time; ?>
                                    </td>
                                    <td>
                                        <form method="post" action="">
                                            <input type="hidden" name="appointment_id"
                                                value="<?php echo $data['appointment_id']; ?>">
                                            <button type="submit" name="delete" class="button">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">There are no bookings yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>
    </main>
</body>

</html>