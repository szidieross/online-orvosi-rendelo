<?php
session_start();
include_once("classes/Database.php");
include_once("controllers/DoctorController.php");
include_once("controllers/AppointmentController.php");

$id = isset($_GET['id']) ? $_GET["id"] : 0;

$database = Database::getInstance();
$doctorHandler = new DoctorController($database);
$doctor = $doctorHandler->getDoctorById($id);
$appointmentHandler = new AppointmentController($database);
$availableAppointments = $appointmentHandler->getAppointmentByDoctorId($id);

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
                $time = date("H:i:s", strtotime($appointmentDateTime)); ?>

                <tr>
                    <td>
                        <?php echo $date; ?>
                    </td>
                    <td>
                        <?php echo $time; ?>
                    </td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="appointment_id"
                                value="<?php echo $appointment['appointment_id']; ?>">
                            <input type="submit" name="bookAppointment" value="Book Appointment">
                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>