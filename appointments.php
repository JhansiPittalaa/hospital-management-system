<?php
$servername = "localhost";
$username = "root";
$password = ""; // Ensure this is correct, leave it empty if no password is set
$database = "hospital"; // Ensure this matches the database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Appointments</title>
    <style>
        body {
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
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this appointment?")) {
                window.location.href = "delete_appointment.php?id=" + id;
            }
        }
    </script>
</head>
<body>
    <h2>Appointments List</h2>
    <form method="GET" action="">
        <input type="text" id="search" name="search" placeholder="Search by patient name, doctor, or department..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <tr>
            <th>Patient ID</th>
            <th>Patient Name</th>
            <th>Doctor</th>
            <th>Purpose</th>
            <th>Appointment Date</th>
            <th>Time</th>
            <th>Room</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
        
        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT p.id, p.patient_id, p.patient_name, d.doctor_name, p.purpose, p.appointment_date, p.appointment_time, d.room_number, d.department 
                FROM patients p 
                JOIN doctors d ON p.doctor_id = d.doctor_id 
                WHERE p.patient_name LIKE '%$search%' OR d.doctor_name LIKE '%$search%' OR d.department LIKE '%$search%'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['patient_id']}</td>
                    <td>{$row['patient_name']}</td>
                    <td>{$row['doctor_name']}</td>
                    <td>{$row['purpose']}</td>
                    <td>{$row['appointment_date']}</td>
                    <td>{$row['appointment_time']}</td>
                    <td>{$row['room_number']}</td>
                    <td>{$row['department']}</td>
                    <td>
                        <a href='update_appointment.php?id={$row['id']}'>Edit</a> | 
                        <a href='#' onclick='confirmDelete({$row['id']})'>Delete</a>
                    </td>
                  </tr>";
        }
        ?>
    </table><br><br>
    <button type="button" onclick="window.location.href='WEB.html';">Back to Home</button>
    <button type="button" onclick="window.location.href='text.html';">Conversation</button>
    <button type="button" onclick="window.location.href='doctor_register.php';">Doctor Reg</button>
    <button type="button" onclick="window.location.href='patient_register.php';">Patient Reg</button>
</body>
</html>