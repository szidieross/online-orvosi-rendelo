<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <div class="">
        <h4>
            <a href="index.php" class=""><button class="btn">BACK</button></a>
        </h4>
        <div class="form">
            <form action="" method="post">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control"
                        value="">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control">
                </div>
                ADD ROLE
                <div class="form-group">
                    <input type="submit" name="register" class="btn" value="Sign Up">
                </div>
            </form>
            <p>Already have an account? <a href="login.php"> <button class="btn">Sign in</button></a></p>
        </div>
    </div>
</body>

</html>