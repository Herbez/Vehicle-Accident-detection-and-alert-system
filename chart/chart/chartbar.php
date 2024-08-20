<?php
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
		text: "Wind speed data sensor"
	},
	axisY: {
		title: "Wind Speed (Km/h)",
		titleFontSize: 24,
		prefix: ""
	},
	data: [{
		type: "line",
		yValueFormatString: "#,##0.00",
		dataPoints: <?php echo json_encode( $test, JSON_NUMERIC_CHECK); ?>
	}]
});
 
function addData(data) {
	var dps = data.price_usd;
	for (var i = 0; i < dps.length; i++) {
		dataPoints.push({
			x: new Date(dps[i][0]),
			y: dps[i][1]
		});
	}
	chart.render();
}
 
$.getJSON("https://canvasjs.com/data/gallery/php/bitcoin-price.json", addData);
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
</body>
</html>   