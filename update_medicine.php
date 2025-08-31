<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM medicines WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $threshold = $_POST['threshold'];

    $sql = "UPDATE medicines SET name='$name', quantity='$quantity', threshold='$threshold' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: medican_stock.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Medicine</title>  <style>body {
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


</style>
</head>
<body>
    <h2>Update Medicine</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $row['name'] ?>" required><br>
        <label>Quantity:</label>
        <input type="number" name="quantity" value="<?= $row['quantity'] ?>" required><br>
        <label>Threshold:</label>
        <input type="number" name="threshold" value="<?= $row['threshold'] ?>" required><br>
        <button type="submit">Update</button>
    </form>
    <a href="medican_stock.php">Back</a>
</body>
</html>
