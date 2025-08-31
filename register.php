<?php
include 'db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    // Generate a Unique ID
    $prefix = ($role == "Doctor") ? "DOC" : (($role == "Admin") ? "ADM" : "PAT");
    $unique_id = $prefix . rand(1000, 9999);

    // Generate a Strong Password
    function generatePassword($length = 12) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+=-';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }

    $plain_password = generatePassword(12);
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT); // Hash password

    // Insert into database
    $sql = "INSERT INTO users (unique_id, name, email, phone, password, role) 
            VALUES ('$unique_id', '$name', '$email', '$phone', '$hashed_password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Registration Successful! Your ID: $unique_id and Password: $plain_password');
                window.location.href = 'login.html';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
