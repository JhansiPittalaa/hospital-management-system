<?php
include('db.php'); // Database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM ambulances WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ambulance deleted successfully!'); window.location.href='ambulance_list.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
