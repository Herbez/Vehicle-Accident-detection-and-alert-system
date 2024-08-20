<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "accident"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the URL
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$accid = $_POST['accident'];

// Insert data into the database
$sql = "INSERT INTO accident_detection (impact_detected,latitude, longitude) VALUES ('$accid','$latitude', '$longitude')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
