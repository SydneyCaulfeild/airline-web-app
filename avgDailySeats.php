<html>
<head>
	<meta charset="utf-8">
	<title>Airline web app.</title>
</head>

<body>
<?php
include 'connectdb.php';
?>

<?php
$radioVal = $_POST["day"];
	$totalQuery = "SELECT SUM(MaxNumSeats) FROM flight 
		JOIN flightdays ON flight.FlightNum = flightdays.FlightNum 
		JOIN airplane ON flight.AirplaneID = airplane.Id 
		JOIN airplanetype ON airplane.PlaneTypeName = airplanetype.Name WHERE day = '$radioVal' ";
	$countQuery = "SELECT COUNT(MaxNumSeats) FROM flight 
		JOIN flightdays ON flight.FlightNum = flightdays.FlightNum 
		JOIN airplane ON flight.AirplaneID = airplane.Id 
		JOIN airplanetype ON airplane.PlaneTypeName = airplanetype.Name WHERE day = '$radioVal' ";
$total = $connection->query($totalQuery);
$row1 = $total->fetch();

$count = $connection->query($countQuery);
$row2 = $count->fetch();

$totalNum = $row1["SUM(MaxNumSeats)"];
$countNum = $row2["COUNT(MaxNumSeats)"];

if (!($countNum)) {
	$countNum = 1;
}

$avg = $totalNum / $countNum;

echo ("On $radioVal there are an average of $avg seats available.");

?>
	<p>Click below to return to the home page.</p>
	<button onclick="window.location.href='/airline.php';">
      		Return to home page
    	</button>

</body>
</html>
