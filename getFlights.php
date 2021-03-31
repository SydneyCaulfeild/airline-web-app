<?php
include 'connectdb.php';
?>
	<?php
$result = $connection->query("select * from flight where schedArrival = ActualArrival");
echo "<table border='1'>
<tr>
<th>Flight Number</th>
<th>Arrival Time</th>
</tr>";


while ($row = $result->fetch()) {
	echo "<tr>";
	echo "<td>" . $row["FlightNum"] . "</td>";
	echo "<td>" . $row["SchedArrival"] . "</td>";
	 echo "</tr>";
}
echo "</table>";
?>

