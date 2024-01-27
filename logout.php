<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["doctor"]);
header("Location: login.php");