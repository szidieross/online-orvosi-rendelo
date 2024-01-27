<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Appointment</title>
</head>
<body>
    <h2>Create Appointment</h2>
    <form action="create_appointment.php" method="post">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" required><br>

        <label for="doctor_id">Doctor ID:</label>
        <input type="text" name="doctor_id" required><br>

        <label for="appointment_time">Appointment Time:</label>
        <input type="datetime-local" name="appointment_time" required><br>

        <input type="submit" value="Create Appointment">
    </form>
</body>
</html>
