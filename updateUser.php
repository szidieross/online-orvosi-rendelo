<?php
session_start();
include_once("classes/Database.php");
include_once("controllers/UserController.php");
include_once("controllers/DoctorController.php");

$database = Database::getInstance();
$userHandler = new UserController($database);
$doctorHandler = new DoctorController($database);

$id = isset($_GET['id']) ? $_GET['id'] : 0;

echo "ID: " . $id;

$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $database->prepare($sql);

$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("Hiba a SELECT lekérdezés során: " . $database->error);
}

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    $firstName = $userData['first_name'];
    $lastName = $userData['last_name'];
    $username = $userData['username'];
    $email = $userData['email'];
} else {
    die("No user found with ID: " . $id);
}

$stmt->close();

if (isset($_POST['update']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];

    if (isset($_SESSION['doctor'])) {
        $doctorHandler->updateDoctorData($firstName, $lastName, $id);
        $userHandler->updateUserData($firstName, $lastName, $username, $email, $id);
    } else {
        $userHandler->updateUserData($firstName, $lastName, $username, $email, $id);

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szerkeszt</title>
</head>

<body>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $userData["user_id"]; ?>">
        First Name: <input type="text" name="first_name" value="<?php echo $firstName; ?>" required><br><br>
        Last Name: <input type="text" name="last_name" value="<?php echo $lastName; ?>" required><br><br>
        Username: <input type="text" name="username" value="<?php echo $username; ?>" required><br><br>
        Email: <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>
        <input type="submit" name="update" value="Ment">
    </form>
</body>

</html>