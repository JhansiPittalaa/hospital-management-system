<?php
require 'vendor/autoload.php'; // Load PHPSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Database connection
$mysqli = new mysqli("localhost", "root", "", "hospital");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch all payments
$result = $mysqli->query("SELECT * FROM payment");

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set column headers
$sheet->setCellValue('A1', 'Payment ID');
$sheet->setCellValue('B1', 'Patient Name');
$sheet->setCellValue('C1', 'Amount');
$sheet->setCellValue('D1', 'Payment Status');
$sheet->setCellValue('E1', 'QR Code Path');

$row = 2; // Start from row 2

// Fetch and write data into Excel
while ($payment = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $payment['payment_id']);
    $sheet->setCellValue('B' . $row, $payment['patient_name']);
    $sheet->setCellValue('C' . $row, $payment['amount']);
    $sheet->setCellValue('D' . $row, $payment['payment_status']);
    $sheet->setCellValue('E' . $row, $payment['qr_code']);
    $row++;
}

// Set headers for download
$filename = "payments.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
