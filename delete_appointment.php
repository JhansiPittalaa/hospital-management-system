<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM patients WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

header("Location: appointments.php");
exit();
?>
