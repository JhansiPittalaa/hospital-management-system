<?php
include('db.php'); // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $driver_name = $_POST['driver_name'];
    $ambulance_number = $_POST['ambulance_number'];
    $availability = $_POST['availability'];

    // Insert into database
    $sql = "INSERT INTO ambulances (driver_name, ambulance_number, availability) 
            VALUES ('$driver_name', '$ambulance_number', '$availability')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ambulance Registered Successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambulance Registration</title>
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

/* Styling for Medicine Update Form */
.update-medicine-form {
    max-width: 500px;
    margin: auto;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
    border: 3px solid #1976d2;
}

.update-medicine-form input[type="text"],
.update-medicine-form input[type="number"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-top: 5px;
    border: 2px solid #42a5f5;
    border-radius: 5px;
    font-size: 16px;
    background-color: #e3f2fd;
}

.update-medicine-form button {
    width: 100%;
    padding: 12px;
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

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: white;
}

table, th, td {
    border: 1px solid #0d47a1;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #1976d2;
    color: white;
}

tr:nth-child(even) {
    background-color: #e3f2fd;
}

/* Buttons for Edit & Delete */
.edit-btn, .delete-btn {
    padding: 8px 12px;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 5px;
}

.edit-btn {
    background-color: #ffc107;
}

.edit-btn:hover {
    background-color: #ff9800;
}

.delete-btn {
    background-color: #d32f2f;
}

.delete-btn:hover {
    background-color: #b71c1c;
}

/* Search Bar Styling */
#search {
    width: 50%;
    padding: 10px;
    border: 2px solid #42a5f5;
    border-radius: 5px;
    font-size: 16px;
    margin-top: 10px;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Register Ambulance</h2>
        <form method="post" action="">
            <label>Driver Name:</label>
            <input type="text" name="driver_name" required>
            
            <label>Ambulance Number:</label>
            <input type="text" name="ambulance_number" required>

            <label>Availability:</label>
            <select name="availability">
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
            </select>

            <button type="submit">Register</button>
            <br><br>
        </form>
        <button type="button" onclick="window.location.href='web.html';" style="padding: 10px 20px;">back to home</button>

        <br>
        <a href="ambulance_list.php">View Ambulances</a>
    </div>
</body>
</html>
