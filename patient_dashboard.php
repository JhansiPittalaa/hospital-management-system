<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "Patient") {
    header("Location: login.html");
    exit();
}
echo "<h1>Welcome, Patient</h1>";
echo "<a href='logout.php'>Logout</a>";
?>
