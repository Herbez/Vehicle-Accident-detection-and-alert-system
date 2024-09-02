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

$sql = "SELECT latitude, longitude, dtime, licenseplate, fnames, familyphone 
FROM accident_detection a 
JOIN vehicle v ON a.vehicle_id = v.vehicleid
JOIN owner o ON v.ownerid = o.ownerid
ORDER BY dtime DESC LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $latitude = $row['latitude'];
    $longitude = $row['longitude'];
    $dtime = $row['dtime'];
    $fnames = $row['fnames'];
    $familyphone = $row['familyphone'];
    $licenseplate = $row['licenseplate'];
} else {
    echo "No data found";
    exit;
}

// Create the message
$message = "Accident detected at\n";
$message .= "Location: https://maps.google.com/?q=$latitude,$longitude \n";
$message .= "Victim's Name: $fnames\n";
// $message .= "Vehicle License plate: $licenseplate\n";


// $familyphone
$data=array(
    "sender"=>'+250789091938',
    "recipients"=> $familyphone ,
    "message"=>$message,
  );

$url="https://www.intouchsms.co.rw/api/sendsms/.json";
$data=http_build_query($data);
$username="Herbez";
$password="Hpass@intouch#7";

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_USERPWD,$username.":".$password);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$result=curl_exec($ch);
$httpcode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
curl_close($ch);


?>