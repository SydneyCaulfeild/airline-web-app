
<?php
   $query = "SELECT * FROM airline";
   $result = $connection->query($query);
   while ($row = $result->fetch()) {
        echo '<input type="radio" name="availableAirlines" value="';
	echo $row["AirlineCode"];
        echo '">' . $row["AirlineCode"] . "<br>";
   }
?>
