<?php include("db.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Registration</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f8ff;
    text-align: center;
    margin: 0;
    padding: 20px;
}

h2, h1 {
    color: #0d47a1;
}

form {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
    display: inline-block;
    text-align: left;
    max-width: 450px;
    width: 100%;
    border: 3px solid #1976d2;
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
    color: #0d47a1;
}

input[type="text"],
input[type="number"],
input[type="date"],
input[type="time"],
textarea,
select {
    width: calc(100% - 20px);
    padding: 10px;
    margin-top: 5px;
    border: 2px solid #42a5f5;
    border-radius: 5px;
    font-size: 16px;
    background-color: #e3f2fd;
}

button, input[type="submit"] {
    background-color: #0d47a1;
    color: white;
    border: none;
    padding: 12px 20px;
    margin-top: 15px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    transition: background 0.3s ease;
}

button:hover, input[type="submit"]:hover {
    background-color: #002171;
}

a {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #1565c0;
    font-size: 16px;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
    color: #002171;
}

.container {
    width: 50%;
    margin: auto;
    padding: 10px;
    border: 3px solid #0d47a1;
    border-radius: 10px;
    background-color: #bbdefb;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    border: 1px solid black;
    text-align: center;
}

th {
    background-color: #1976d2;
    color: white;
}

#search {
    width: 50%;
    padding: 10px;
    margin-bottom: 10px;
    font-size: 16px;
    border: 2px solid #42a5f5;
    border-radius: 5px;
}

.btn {
    padding: 10px 15px;
    text-decoration: none;
    color: white;
    border-radius: 5px;
    margin: 2px;
    font-weight: bold;
}

.edit-btn {
    background-color: #ff9800;
}

div.delete-btn {
    background-color: #d32f2f;
}

.add-btn {
    background-color: #0d47a1;
    display: inline-block;
    margin-bottom: 10px;
    padding: 12px 20px;
    font-size: 16px;
}

/* Additional Styling */
.appointment-table {
    background-color: #f5f5f5;
    border-radius: 10px;
    padding: 15px;
}

th {
    background-color: #004d40;
    color: white;
}

tr:nth-child(even) {
    background-color: #e0f2f1;
}

tr:hover {
    background-color: #b2dfdb;
}

    </style>
</head>
<body>
    <h2>Patient Registration</h2>
    <form action="patient_register.php" method="post">
        Patient ID: <input type="text" name="patient_id" required><br>
        Name: <input type="text" name="patient_name" required><br>
        Mobile: <input type="text" name="mobile" required><br>
        Address: <textarea name="address" required></textarea><br>
        
        Select Doctor:
        <select name="doctor_id">
            <?php
            $result = $conn->query("SELECT * FROM doctors");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['doctor_id']}'>{$row['doctor_name']} - {$row['specialization']} ({$row['available_date']} {$row['available_time']})</option>";
            }
            ?>
        </select><br>
        
        Purpose: <input type="text" name="purpose" required><br>
        Appointment Date: <input type="date" name="appointment_date" required><br>
        Appointment Time: <input type="time" name="appointment_time" required><br>
        <button type="submit" name="submit">Register Patient</button>
        <button type="button" onclick="window.location.href='appointments.php';" style="padding: 10px 20px;"> GO TO Appointment</button>

    </form>
    <button type="button" onclick="window.location.href='web.html';" style="padding: 10px 20px;">back to home</button>
 </body>
</html>

<?php
if (isset($_POST['submit'])) {
    $patient_id = $_POST['patient_id'];
    $patient_name = $_POST['patient_name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $doctor_id = $_POST['doctor_id'];
    $purpose = $_POST['purpose'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $sql = "INSERT INTO patients (patient_id, patient_name, mobile, address, doctor_id, purpose, appointment_date, appointment_time) 
            VALUES ('$patient_id', '$patient_name', '$mobile', '$address', '$doctor_id', '$purpose', '$appointment_date', '$appointment_time')";

    if ($conn->query($sql) === TRUE) {
        echo "Patient registered successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
