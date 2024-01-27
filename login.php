<?php
include_once('classes/Database.php');
include_once('controllers/UserController.php');
$database = Database::getInstance();

if (isset($_POST["signup"]) && $_SERVER['REQUEST_METHOD'] === "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        die("Hiba: a mezok kitoltese kotelezo!");
    }

    $sql = "SELECT username, password FROM users WHERE username = ?";

    $stmt = $database->prepare($sql);

    if ($stmt === false) {
        die("Hiba a lekerdezes elokeszitese soran: " . $conn->error);
    }

    $stmt->bind_param("s", $username);

    if (!$stmt->execute()) {
        die("Hiba a lekerdezes soran: " . $conn->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            echo "Sikeres bejelentkezes";

            $_SESSION["username"] = $username;
            // setcookie("username", $username, time() + (86400 * 30));

            header("Location: index.php");
        } else {
            echo "Hibas jelszo";
        }
    } else {
        echo "Felhasznalonev nem talalhato.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <h2>Welcome</h2>
    <h4>
        <a href="index.php" class=""><button class="btn">BACK</button></a>
    </h4>
    <div class="main-container">
        <div class="form">
            <form action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="signup" class="btn" value="Sign Up">
                </div>
            </form>
            <p>Don't have an account? <a href="signup.php"> <button class="btn">Sign up</button></a></p>
        </div>
    </div>
</body>

</html>