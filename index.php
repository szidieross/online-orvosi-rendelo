<?php

include('classes/Database.php');

echo "hello";
$database = new Database();
$database->initializeDatabase();
$conn=$database->getConnection();

?>
