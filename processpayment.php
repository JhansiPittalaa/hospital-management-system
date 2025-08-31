<?php
$mysqli = new mysqli("localhost", "root", "", "hospital");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$patient_name = htmlspecialchars($_POST['patient_name']);
$amount = floatval($_POST['amount']);

// Insert payment with "Pending" status
$sql = "INSERT INTO payment (patient_name, amount, payment_status) VALUES (?, ?, 'Pending')";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sd", $patient_name, $amount);
$stmt->execute();
$payment_id = $mysqli->insert_id;

// Generate QR Code
require 'phpqrcode/qrlib.php';
$qr_text = "Payment ID: $payment_id\nPatient: $patient_name\nAmount: $amount\nStatus: Pending";
$qr_file = "qrcodes/payment_$payment_id.png";

// Ensure `qrcodes` directory exists
if (!file_exists('qrcodes')) {
    mkdir('qrcodes', 0777, true);
}

QRcode::png($qr_text, $qr_file, QR_ECLEVEL_L, 5);

// Update database with QR Code path
$update_sql = "UPDATE payment SET qr_code=? WHERE payment_id=?";
$stmt = $mysqli->prepare($update_sql);
$stmt->bind_param("si", $qr_file, $payment_id);
$stmt->execute();

// Redirect to receipt page
header("Location: receipt.php?id=$payment_id");
exit;
?>
