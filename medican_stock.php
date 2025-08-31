<?php
include('db.php');

// Fetch all medicines
$sql = "SELECT * FROM medicines";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Stock</title>
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
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this medicine?")) {
                window.location.href = 'delete_medicine.php?id=' + id;
            }
        }
    </script>
</head>
<body>

    <h2>Medicine Stock Management</h2>
    <a href="add_medicine.php">➕ Add New Medicine</a>
    
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Threshold</th>
            <th>Action</th>
        </tr>
        
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['threshold'] . "</td>";
                echo "<td>
                        <a href='update_medicine.php?id=" . $row['id'] . "'>✏️ Edit</a> |
                        <a href='#' onclick='confirmDelete(" . $row['id'] . ")'>🗑️ Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No medicines found</td></tr>";
        }
        ?>
    </table>
    <br><br><button type="button" onclick="window.location.href='web.html';" style="padding: 10px 20px;">back to home</button>
</body>
</html>

<?php $conn->close(); ?>
