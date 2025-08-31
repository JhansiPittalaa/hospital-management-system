<?php
session_start();
include 'db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unique_id = $_POST['unique_id'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE unique_id = '$unique_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == "Patient") {
                header("Location: WEB.html");
            } elseif ($user['role'] == "Doctor") {
                header("Location: WEB.html");
            } else {
                header("Location: WEB.html");
            }
            exit();
        } else {
            echo "<script>alert('Invalid password!'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid Unique ID!'); window.location.href='login.html';</script>";
    }
}
?>
