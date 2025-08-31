<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "Admin") {
    header("Location: login.html");
    exit();
}
echo "<h1>Welcome, Admin</h1>";
echo "<a href='logout.php'>Logout</a>";
?>
