<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "accident";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM vehicle v JOIN accident_detection a ON v.vehicleid = a.vehicle_id ORDER BY a.dtime DESC LIMIT 2"; // Adjust the query as per your notifications table structure
$result = $conn->query($sql);

$notifications = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = [
            'message' => "<pan class='badge badge-warning'>Accident detected <span><br>" . 
                         'License Plate: ' . $row['licenseplate'] . '<br>' 
        ];
    }
}

echo json_encode($notifications, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
$conn->close();
?>
