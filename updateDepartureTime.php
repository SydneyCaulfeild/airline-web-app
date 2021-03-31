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
	<h1>Update Departure Time</h1>

<?php
$radioVal = $_POST["deptTimes"];
$hour = $_POST['hour'];
$minute = $_POST['minute'];
$second = $_POST['second'];
$time = $hour . ":" . $minute . ":" . $second;
$query = 'SELECT * FROM flight WHERE flight.FlightNum ="' . $radioVal . '"';
 $result=$connection->query($query);
    while ($row=$result->fetch()) {
	$flightNum = $row["FlightNum"];
	$sql = ' UPDATE flight SET ActualDepart = "' . $time . '" WHERE FlightNum = "' . $flightNum . '"';
	$numRows = $connection->exec($sql);
    }
?>

<?php
$result = $connection->query("select * from flight");
echo "<ol>";
while ($row = $result->fetch()) {
	echo "<li>";
	$sched = $row["SchedDepart"];
	$actual = $row["ActualDepart"];
	if (empty($row["SchedDepart"])) {
		$sched = "no data";
	}
	if (empty($row["ActualDepart"])) {
		$actual = "no data";
	}
	echo "Flight Number: " . $row["FlightNum"]  . ", Scheduled Departure Time: " . $sched . ", Current Actual Departure Time: " . $actual . "</li>";
}
echo "</ol>";
?>

	<p>Click below to return to the home page.</p>
	<button onclick="window.location.href='/airline.php';">
      		Return to home page
    	</button>

</body>
</html>
