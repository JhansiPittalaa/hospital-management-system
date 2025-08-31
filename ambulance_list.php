<?php
include('db.php'); // Database connection

// Fetch ambulance records
$sql = "SELECT * FROM ambulances";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambulance List</title>
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

.container {
    width: 80%;
    margin: auto;
    padding: 20px;
    border: 2px solid blue;
    border-radius: 10px;
    background-color: #bbdefb;
    position: relative;
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
    background-color:  #007bff;
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
    background-color:  #007bff;
}

.edit-btn:hover {
    background-color:rgb(0, 26, 255);
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
        <h2>Registered Ambulances</h2>

        <!-- Search Input Field -->
        <input type="text" id="search" placeholder="Search by ambulance number..." onkeyup="filterTable()">
        
        <br><br>

        <!-- Add Ambulance Button -->
        <a href="ambulance_register.php" class="btn add-btn">➕ Add Ambulance</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Driver Name</th>
                <th>Ambulance Number</th>
                <th>Availability</th>
                <th>Actions</th> <!-- New column for edit & delete buttons -->
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['driver_name']; ?></td>
                    <td><?php echo $row['ambulance_number']; ?></td>
                    <td><?php echo $row['availability']; ?></td>
                    <td>
                        <a href="edit_ambulance.php?id=<?php echo $row['id']; ?>" class="btn edit-btn">✏️ Edit</a>
                        <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn delete-btn">🗑️ Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No ambulances found.</td>
                </tr>
            <?php endif; ?>
        </table>
        <br><br><button type="button" onclick="window.location.href='WEB.html';" style="padding: 10px 20px;">back to home</button>
        <button type="button" onclick="window.location.href='http://localhost/PHAMACY/phamacy.html';" style="padding: 10px 20px;">PHARMACY</button>
    </div>

    <script>
        function filterTable() {
            let input = document.getElementById("search").value.toUpperCase();
            let table = document.querySelector("table");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let ambulanceNumber = cells[2]?.innerText || "";
                
                if (ambulanceNumber.toUpperCase().indexOf(input) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this ambulance?")) {
                window.location.href = "delete_ambulance.php?id=" + id;
            }
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
