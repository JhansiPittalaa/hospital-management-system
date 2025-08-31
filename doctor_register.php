<?php include("db.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor Registration</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #e3f2fd;
    text-align: center;
    margin: 0;
    padding: 20px;
}

h2, h1 {
    color: #1a237e;
}

form {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    display: inline-block;
    text-align: left;
    max-width: 400px;
    width: 100%;
    border: 2px solid #1e88e5;
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
    color: #1565c0;
}

input[type="text"],
input[type="number"],
input[type="date"],
input[type="time"],
select {
    width: calc(100% - 20px);
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #64b5f6;
    border-radius: 5px;
    font-size: 16px;
    background-color: #e3f2fd;
}

button, input[type="submit"] {
    background-color: #0288d1;
    color: white;
    border: none;
    padding: 10px 20px;
    margin-top: 15px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    transition: background 0.3s ease;
}

button:hover, input[type="submit"]:hover {
    background-color: #01579b;
}

a {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #0288d1;
    font-size: 16px;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
    color: #01579b;
}

.container {
    width: 80%;
    margin: auto;
    padding: 20px;
    border: 2px solid #1a237e;
    border-radius: 10px;
    background-color: #bbdefb;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    border: 1px solid black;
    text-align: center;
}

th {
    background-color: #1e88e5;
    color: white;
}

#search {
    width: 50%;
    padding: 10px;
    margin-bottom: 10px;
    font-size: 16px;
    border: 1px solid #64b5f6;
    border-radius: 5px;
}

.btn {
    padding: 8px 12px;
    text-decoration: none;
    color: white;
    border-radius: 5px;
    margin: 2px;
    font-weight: bold;
}

.edit-btn {
    background-color: #ff9800;
}

.delete-btn {
    background-color: #d32f2f;
}

.add-btn {
    background-color: #1565c0;
    display: inline-block;
    margin-bottom: 10px;
}

/* Additional Styling */
.appointment-table {
    background-color: #f5f5f5;
    border-radius: 10px;
    padding: 10px;
}

th {
    background-color: #00796b;
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
    <h2>Doctor Registration</h2>
    <form action="doctor_register.php" method="post">
        Doctor ID: <input type="text" name="doctor_id" required><br>
        Name: <input type="text" name="doctor_name" required><br>
        Specialization: 
        <select name="specialization">
            <option value="Neuro">Neuro</option>
            <option value="General">General</option>
            <option value="Other">Other</option>
        </select><br>
        Available Date: <input type="date" name="available_date" required><br>
        Available Time: <input type="time" name="available_time" required><br>
        Department: <input type="text" name="department" required><br>
        Room Number: <input type="text" name="room_number" required><br>
        <button type="submit" name="submit">Register Doctor</button>
        <br><br>
    </form>
    <button type="button" onclick="window.location.href='web.html';" style="padding: 10px 20px;">back to home</button>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $doctor_id = $_POST['doctor_id'];
    $doctor_name = $_POST['doctor_name'];
    $specialization = $_POST['specialization'];
    $available_date = $_POST['available_date'];
    $available_time = $_POST['available_time'];
    $department = $_POST['department'];
    $room_number = $_POST['room_number'];

    $sql = "INSERT INTO doctors (doctor_id, doctor_name, specialization, available_date, available_time, department, room_number) 
            VALUES ('$doctor_id', '$doctor_name', '$specialization', '$available_date', '$available_time', '$department', '$room_number')";

    if ($conn->query($sql) === TRUE) {
        echo "Doctor registered successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
