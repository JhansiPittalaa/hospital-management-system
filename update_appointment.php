<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM patients WHERE id = $id");
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $patient_name = $_POST['patient_name'];
    $purpose = $_POST['purpose'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $sql = "UPDATE patients SET 
            patient_name = '$patient_name', 
            purpose = '$purpose', 
            appointment_date = '$appointment_date', 
            appointment_time = '$appointment_time' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment updated successfully!";
        header("Location: appointments.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Appointment</title>
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
    width: 80%;
    margin: auto;
    padding: 20px;
    border: 2px solid #0d47a1;
    border-radius: 10px;
    background-color: #bbdefb;
    position: relative;
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

.delete-btn {
    background-color: #d32f2f;
}

.add-btn {
    background-color: #0d47a1;
    display: inline-block;
    padding: 12px 20px;
    font-size: 16px;
    position: absolute;
    top: 10px;
    right: 10px;
    text-decoration: none;
    color: white;
    border-radius: 5px;
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

/* QR Scanner and Payment Section */
#qr-image {
    width: 200px;
    margin-top: 10px;
    border: 3px solid #1976d2;
    border-radius: 10px;
}

video {
    width: 100%;
    max-width: 300px;
    border: 3px solid #0d47a1;
    border-radius: 10px;
    margin-top: 10px;
}

#payment-form {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
    border: 3px solid #1976d2;
}

/* Receipt Table */
.receipt-table {
    width: 50%;
    margin: auto;
    border-collapse: collapse;
    border: 2px solid #0d47a1;
    border-radius: 10px;
}

.receipt-table th {
    background-color: #0d47a1;
    color: white;
    padding: 10px;
    border: 1px solid #1976d2;
}

.receipt-table td {
    padding: 10px;
    border: 1px solid #1976d2;
    text-align: left;
}

.print-button {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #0d47a1;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.print-button:hover {
    background-color: #002171;
}

/* Update Appointment Page */
.update-form {
    max-width: 500px;
    margin: auto;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
    border: 3px solid #1976d2;
}

.update-form input[type="text"],
.update-form input[type="date"],
.update-form input[type="time"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-top: 5px;
    border: 2px solid #42a5f5;
    border-radius: 5px;
    font-size: 16px;
}

.update-form button {
    width: 100%;
    padding: 12px;
}
</style>
</head>
<body>
    <h2>Update Appointment</h2>
    <form action="" method="post">
        Patient Name: <input type="text" name="patient_name" value="<?php echo $row['patient_name']; ?>" required><br>
        Purpose: <input type="text" name="purpose" value="<?php echo $row['purpose']; ?>" required><br>
        Appointment Date: <input type="date" name="appointment_date" value="<?php echo $row['appointment_date']; ?>" required><br>
        Appointment Time: <input type="time" name="appointment_time" value="<?php echo $row['appointment_time']; ?>" required><br>
        <button type="submit" name="update">Update Appointment</button>
    </form>
</body>
</html>
