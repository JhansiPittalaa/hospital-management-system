<?php 
// Database connection
$mysqli = new mysqli("localhost", "root", "", "hospital");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Ensure 'id' exists in GET request
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Payment ID is missing.");
}

$payment_id = intval($_GET['id']); // Convert to integer for safety

// Fetch payment details securely using prepared statement
$stmt = $mysqli->prepare("SELECT * FROM payment WHERE payment_id = ?");
$stmt->bind_param("i", $payment_id);
$stmt->execute();
$result = $stmt->get_result();
$payment = $result->fetch_assoc();

if (!$payment) {
    die("Error: Payment record not found.");
}

// If "Mark as Completed" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mark_completed'])) {
    $update_stmt = $mysqli->prepare("UPDATE payment SET payment_status='Completed' WHERE payment_id=?");
    $update_stmt->bind_param("i", $payment_id);
    $update_stmt->execute();
    header("Location: receipt.php?id=$payment_id"); // Refresh page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; text-align: center; }
        img { border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 150px; }
        button { padding: 10px; background: green; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

<div class="container">
    <h2>Payment Receipt</h2>
    <p><strong>Patient Name:</strong> <?= htmlspecialchars($payment['patient_name']) ?></p>
    <p><strong>Amount:</strong> $<?= htmlspecialchars($payment['amount']) ?></p>
    <p><strong>Payment Status:</strong> <?= htmlspecialchars($payment['payment_status']) ?></p>
    <img src="qr_code.jpg" alt="QR Code">

    <?php if ($payment['payment_status'] == 'Pending'): ?>
        <form method="post">
            <button type="submit" name="mark_completed">Mark as Completed</button>
        </form>
    <?php else: ?>
        <p style="color: green;"><strong>Payment Completed ✅</strong></p>
    <?php endif; ?>
</div>
<button type="button" onclick="window.location.href='ambulance_register.php';" style="padding: 10px 20px;">ambulance</button>
</body>
</html>