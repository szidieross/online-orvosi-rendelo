<?php
session_start();
include_once("classes/Database.php");
include_once("controllers/DoctorController.php");
include_once("controllers/AppointmentController.php");
include_once("controllers/userController.php");

$id = isset($_GET['id']) ? $_GET["id"] : 0;

$database = Database::getInstance();
$userHandler = new userController($database);

$username = $_SESSION["username"];
echo $username;
$user = $userHandler->getUserData($username);
$userId = $user["user_id"];

$doctorHandler = new DoctorController($database);
$doctor = $doctorHandler->getDoctorById($id);
$appointmentHandler = new AppointmentController($database);
$availableAppointments = $appointmentHandler->getAppointmentByDoctorId($id);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["book"])) {
    $id = $_POST["appointmentId"];

    $appointmentHandler->book($userId, $id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
</head>

<body>
    <h2>
        <?php echo $doctor["first_name"] . " " . $doctor["last_name"]; ?>'s Available Appointments
    </h2>

    <table>
        <thead>
            <tr>
                <th>Day</th>
                <th>Appointment Time</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($availableAppointments as $appointment):
                $appointmentDateTime = $appointment['appointment_time'];
                $date = date("Y-m-d", strtotime($appointmentDateTime));
                $time = date("H:i:s", strtotime($appointmentDateTime));
                ?>
                <tr>
                    <td>
                        <?php echo $date; ?>
                    </td>
                    <td>
                        <?php echo $time; ?>
                    </td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="appointmentId" value="<?php echo $appointment['appointment_id']; ?>">
                            <input type="submit" name="book" value="Book Appointment">
                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>