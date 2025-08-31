<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $threshold = $_POST['threshold'];

    $sql = "INSERT INTO medicines (name, quantity, threshold) VALUES ('$name', '$quantity', '$threshold')";
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
    <title>Add Medicine</title>
    <style>body {
    font-family: Arial, sans-serif;
    background-color: #e3f2fd;
    text-align: center;
    margin: 0;
    padding: 20px;
}

h2 {
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
input[type="number"] {
    width: calc(100% - 20px);
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #64b5f6;
    border-radius: 5px;
    font-size: 16px;
    background-color: #e3f2fd;
}

button {
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

button:hover {
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

delete-btn {
    background-color: #d32f2f;
}

.add-btn {
    background-color: #1565c0;
    display: inline-block;
    margin-bottom: 10px;
}

</style>
</head>
<body>
    <h2>Add New Medicine</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Quantity:</label>
        <input type="number" name="quantity" required><br>
        <label>Threshold:</label>
        <input type="number" name="threshold" required><br>
        <button type="submit">Add Medicine</button>
    </form>
    <a href="medican_stock.php">Back</a>
    <br><br><button type="button" onclick="window.location.href='web.html';" style="padding: 10px 20px;">back to home</button>
</body>
</html>
