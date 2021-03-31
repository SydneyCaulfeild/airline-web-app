<?php
include 'connectdb.php';
?>
	<?php
$result = $connection->query("select * from flight where schedArrival = ActualArrival");
echo "<ol>";
while ($row = $result->fetch()) {
	echo "<li>";
	echo "Flight Number: " . $row["FlightNum"] .",  " . "Arrival Time: " . $row["SchedArrival"] . "</li>";
}
echo "</ol>";
?>

