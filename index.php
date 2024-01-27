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


$userHandler->createUser("Amanda", "Seyfried", "amanda", "amanda@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "admin");

$userHandler->createUser("Nicole", "Wallace", "nicole", "nicole@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "user");

// Use the user ID to create a doctor associated with that user
$doctorHandler->createDoctor("Mia", "Torreto", "mia", "mia@example.com", password_hash("secret_password", PASSWORD_DEFAULT), "doctor", "cardiologist");


session_start();
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
        <input type="hidden" name="username" value="<?= $_COOKIE["username"] ?>" />
        <button type="submit" name="logout" value="<?= $user['user_id']; ?>" class="btn">Log Out</button>
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
                <?php
                $user = $_COOKIE['username'];
                $query = "SELECT * FROM users WHERE users.username = '$user'";
                $query_run = mysqli_query($con, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $user) {
                        ?>
                        <tr>
                            <td>
                                <?= $user['first_name']; ?>
                            </td>
                            <td>
                                <?= $user['last_name']; ?>
                            </td>
                            <td>
                                <?= $user['username']; ?>
                            </td>
                            <td>
                                <?= $user['email']; ?>
                            </td>
                            <td>

                                <!-- <a href="user-view.php?id=<?= $user['user_id']; ?>" class="btn btn-info btn-sm">View</a> -->
                                <a href="userEdit.php<?= $user['user_id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <!-- <form action="code.php" method="POST" class="d-inline">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <button type="submit" name="delete_user" value="<?= $user['user_id']; ?>"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                class="btn btn-danger btn-sm">Delete</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </form> -->
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<h5> No Record Found </h5>";
                }
                ?>
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
                <?php
                $user_idd = $_COOKIE["user_id"];
                $query = "SELECT * FROM appointments INNER JOIN users ON appointments.user_id = users.user_id WHERE appointments.user_id = '$user_idd'";
                $query_run = mysqli_query($con, $query);


                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $user) {
                        ?>
                        <?php if ($user['taken'] == true): ?>
                            <tr>
                                <td>
                                    <?= $user['date']; ?>
                                </td>
                                <td>
                                    <?= $user['time']; ?>
                                </td>
                                <td>
                                    <form action="" method="POST" class="">
                                        <input type="hidden" name="appointment_id" value="<?= $user['appointment_id']; ?>" />
                                        <button type="submit" name="delete_booking" value="<?= $user['user_id']; ?>"
                                            class="btn">Delete Appointment</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php
                    }
                } else {
                    echo "<h5> No Record Found </h5>";
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>