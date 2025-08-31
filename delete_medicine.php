<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM medicines WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: medican_stock.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
