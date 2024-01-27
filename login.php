<?php

include_once('classes/Database.php');
$database=Database::getInstance();
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
                    <input type="text" name="username" class="form-control" value="<?php if (isset($_COOKIE["username"])) {
                        echo $_COOKIE["username"];
                    } ?>">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php if (isset($_COOKIE["email"])) {
                        echo $_COOKIE["username"];
                    } ?>">
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