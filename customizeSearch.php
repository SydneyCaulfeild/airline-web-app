<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Airline web app.</title>
</head>

<body>

<?php
include 'connectdb.php';
?>

<h1>Customize Your Search</h1>

<?php
$radioVal = $_POST["day"];
$airline = $_POST["availableAirlines"];
echo ("The following is a list of flights available on $radioVal with $airline airline.");
echo (" If a flight does not have a departure/arrival city, this is because it has not yet been assigned one.");

$query = ' SELECT * FROM flightdays JOIN flight ON flightdays.FlightNum = flight.FlightNum WHERE day="' . $radioVal . '" AND AirlineCode ="' . $airline . '" ';

$result=$connection->query($query);
	echo "<ol>";
    while ($row=$result->fetch()) {
	echo "<li>";
	$flightnumber = $row["FlightNum"];
	echo "Flight Number: " . $flightnumber;
	$departQuery = ' SELECT City FROM flight JOIN airport ON flight.DepAirportCode = airport.AirportCode WHERE flight.FlightNum = "' . $flightnumber . '" ';
	$result2 = $connection->query($departQuery);
	$arrivalQuery = ' SELECT City FROM flight JOIN airport ON flight.DepAirportCode = airport.AirportCode WHERE flight.FlightNum = "' . $flightnumber . '" ';
	$result3 = $connection->query($departQuery);
	while ($row2=$result2->fetch()) {
	echo ". Departure city: " . $row2["City"];
	}
	while ($row3=$result3->fetch()) {
	echo ". Arrival city: " . $row3["City"] . "</li>";
	}
    }
	echo "</ol>";
?>

<p>Click below to return to the home page.</p>
	<button onclick="window.location.href='/airline.php';">
      		Return to home page
    	</button>
</body>
</html>
