<?php
include('db.php'); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $driver_name = $_POST['driver_name'];
    $ambulance_number = $_POST['ambulance_number'];
    $availability = $_POST['availability'];

    // Update query
    $sql = "UPDATE ambulances SET driver_name='$driver_name', ambulance_number='$ambulance_number', availability='$availability' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ambulance updated successfully!'); window.location.href='ambulance_list.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
