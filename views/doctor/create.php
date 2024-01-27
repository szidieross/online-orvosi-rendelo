<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Doctor</title>
</head>
<body>
    <h2>Create Doctor</h2>
    <form action="create_doctor.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="specialty">Specialty:</label>
        <input type="text" name="specialty" required><br>

        <input type="submit" value="Create Doctor">
    </form>
</body>
</html>
