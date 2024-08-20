<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}

// Include database connection file
require('dbconn.php');

// Query to fetch data from records table
$sql="select * from vehicle v join owner o on o.ownerid=v.ownerid join accident_detection a ON v.vehicleid = a.vehicle_id where v.vehicleid = a.vehicle_id order by dtime desc";
$result = $conn->query($sql);

// Set headers for CSV file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="Accident_report.csv"');
header('Cache-Control: max-age=0');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Write headers to the CSV file
fputcsv($output, ['Names','National ID','Phone','Family Member No','License Plate', 'Type', 'GPS Module ID', 'Accident Date']);

// Fetch data from the database and write it to the CSV file
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [$row['fnames'],$row['nationalid'],$row['phone'],$row['familyphone'],$row['licenseplate'], $row['type'], $row['gpsmodid'], $row['dtime']]);
}

// Close database connection
$conn->close();

// End script execution
exit();
?>
