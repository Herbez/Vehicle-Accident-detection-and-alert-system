<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "accident";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn,"accident");
$test = array();
$count = 0;
$res = mysqli_query($conn, "SELECT * FROM accident_records");

if (!$res) {
    die("Error in SQL query: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($res)) {
    $test[$count]["label"] = $row["date_time"];
    $test[$count]["y"] = $row["accident_numbers"];
    $count++;
}

?>



<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var dataPoints = [];
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    zoomEnabled: true,
    title: {
        text: "Road Traffic Accident Data"
    },
    axisY: {
        title: "Number of Incidents",
        titleFontSize: 24,
        prefix: ""
    },
    data: [{
        type: "column",  // Changed from "line" to "column" for bar chart
        yValueFormatString: "#,##0",
        dataPoints: <?php echo json_encode( $test, JSON_NUMERIC_CHECK); ?>
    }]
});
 
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
</body>
</html>