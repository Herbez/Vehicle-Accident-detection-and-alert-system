<?php

$dataPoints = array(
	array("x"=> 10, "y"=> 41),
	array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
	array("x"=> 30, "y"=> 50),
	array("x"=> 40, "y"=> 45),
	array("x"=> 50, "y"=> 52),
	array("x"=> 60, "y"=> 68),
	array("x"=> 70, "y"=> 38),
	array("x"=> 80, "y"=> 71, "indexLabel"=> "Highest"),
	array("x"=> 90, "y"=> 52),
	array("x"=> 100, "y"=> 60),
	array("x"=> 110, "y"=> 36),
	array("x"=> 120, "y"=> 49),
	array("x"=> 130, "y"=> 41)
);
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
mysqli_select_db($conn,"chart_php");
$test = array();
$count = 0;
$res = mysqli_query($conn, "SELECT * FROM chart01");

if (!$res) {
    die("Error in SQL query: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($res)) {
    $test[$count]["label"] = $row["label"];
    $test[$count]["y"] = $row["amount"];
    $count++;
}


?>
<!DOCTYPE HTML>
<html>
<head> 
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "dark2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Simple Column Chart with Index Labels"
	},
	axisY:{
		includeZero: true
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",
		dataPoints: <?php echo json_encode( $test, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>
<!-- <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bitcoin_data";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
mysqli_select_db($conn,"bitcoin_data");
$test = array();
$count = 0;
$res = mysqli_query($conn, "SELECT * FROM bitcoin_prices");

if (!$res) {
    die("Error in SQL query: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($res)) {
    $test[$count]["label"] = $row["date_time"];
    $test[$count]["y"] = $row["price"];
    $count++;
}

?> -->