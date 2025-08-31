<?php
$conn = new mysqli("localhost", "root", "", "hospital");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'];
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

    if ($role === 'doctor') {
        $admin_id = intval($_POST['admin_id']);
        $name = htmlspecialchars(trim($_POST['name']));

        $sql = "INSERT INTO doctorslogin (admin_id, name, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $admin_id, $name, $password);
    } elseif ($role === 'patient') {
        $username = htmlspecialchars(trim($_POST['username']));
        $email = htmlspecialchars(trim($_POST['email']));

        // Check if email already exists
        $check_email = $conn->prepare("SELECT id FROM patientslogin WHERE email = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $check_email->store_result();

        if ($check_email->num_rows > 0) {
            die("Error: Email already exists. Please use another email.");
        }

        $sql = "INSERT INTO patientslogin (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);
    }

    if ($stmt->execute()) {
        echo ucfirst($role) . " registered successfully.";
        header("Location: " . ($role === 'doctor' ? "web.html" : "patient.php"));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
     body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #74ebd5, #acb6e5);
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 100vh;
    margin: 0;
}

h2 {
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

form {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    width: 350px;
    text-align: center;
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
    color: #555;
}

input, select, button {
    width: 100%;
    padding: 10px;
    margin-top: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 14px;
}

button {
    background: linear-gradient(to right, #00c6ff, #0072ff);
    color: white;
    border: none;
    padding: 12px;
    margin-top: 20px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    transition: background 0.3s ease;
}

button:hover {
    background: linear-gradient(to right, #0072ff, #00c6ff);
}

#doctor_fields, #patient_fields {
    display: none;
    margin-top: 15px;
    padding: 10px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

select {
    background: #fff;
    cursor: pointer;
}

    </style>
</head>

<body>
    <h2>login as Doctor or Patient</h2>
    <form method="POST" action="web.html">
        <label for="role">Role:</label>
        <select name="role" id="role" onchange="toggleFields(this.value)" required>
            <option value="" disabled selected>Select Role</option>
            <option value="doctor">Doctor</option>
            <option value="patient">Patient</option>
        </select><br>

        <div id="doctor_fields" style="display: none;">
            <label for="admin_id">Admin ID:</label>
            <input type="number" name="admin_id"><br>

            <label for="name">Name:</label>
            <input type="text" name="name"><br>
        </div>

        <div id="patient_fields" style="display: none;">
            <label for="username">Username:</label>
            <input type="text" name="username"><br>

            <label for="email">Email:</label>
            <input type="email" name="email"><br>
        </div>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit" name="register">Register</button>
    </form>

    <script>
        function toggleFields(role) {
            document.getElementById('doctor_fields').style.display = (role === 'doctor') ? 'block' : 'none';
            document.getElementById('patient_fields').style.display = (role === 'patient') ? 'block' : 'none';
        }
    </script>
</body>
</html>
