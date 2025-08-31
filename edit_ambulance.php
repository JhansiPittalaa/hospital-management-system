<?php
include('db.php'); // Database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch ambulance details
    $sql = "SELECT * FROM ambulances WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Ambulance not found!'); window.location.href='ambulance_list.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='ambulance_list.php';</script>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ambulance</title>
    <style>
  <style>

  body {
    font-family: Arial, sans-serif;
    background-color: #f0f8ff;
    text-align: center;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

h2, h1 {
    color: #0d47a1;
}

.container {
    margin: auto;
  width: 50%;
  border: 3px solid blue;
  padding: 10px;
    border-radius: 10px;
    background-color: #bbdefb;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

form {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    align-items: center;
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

/* Styling for Ambulance List */
.add-btn {
    background-color: blue;
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
    border: 1px solid black;
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
    background-color: #007bff;
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
    background-color: #007bff;
}

.edit-btn:hover {
    background-color: rgb(0, 26, 255);
}

.delete-btn {
    background-color: red;
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
        <h2>Edit Ambulance</h2>
        <form action="update_ambulance.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            
            <label>Driver Name:</label>
            <input type="text" name="driver_name" value="<?php echo $row['driver_name']; ?>" required>

            <label>Ambulance Number:</label>
            <input type="text" name="ambulance_number" value="<?php echo $row['ambulance_number']; ?>" required>

            <label>Availability:</label>
            <select name="availability">
                <option value="Available" <?php echo ($row['availability'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                <option value="Not Available" <?php echo ($row['availability'] == 'Not Available') ? 'selected' : ''; ?>>Not Available</option>
            </select>

            <button type="submit">Update Ambulance</button>
        </form>
        <br>
        <a href="ambulance_list.php">⬅ Back to List</a>
    </div>
</body>
</html>
