<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

include_once("./controllers/UserController.php");
include_once("./classes/Database.php");
$database=Database::getInstance();
$currentUsername = $_SESSION["username"];
$userHandler = new UserController($database);
$userData = $userHandler->getUserData($currentUsername);

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
                    <td><a href="./updateUser.php?id=<?php echo $userData["user_id"]; ?>">Szerkesztés</a></td>
                </tr>
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