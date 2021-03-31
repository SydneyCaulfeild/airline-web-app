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
	<h1>Flight Booking Site</h1>
	<p>Welcome to the home page of our flight booking site.</p>

	<h2>Available Flights</h2>
	<h3>Here are all of our available flights:</h3>
	<p>Note that for the following flights all of the scheduled arrival times are equal to the actual arrival times.</p>
	<?php
		include 'getflights.php';
	?>

	<h2>Customize Your Search</h2>
	<p>Please select the day on which and airline with whom you want to see all flights.</p>
	<form action="customizeSearch.php" method="POST">
	<h5>Day</h5>
  	<input type="radio" id="Monday" name="day" value="Monday">
  	<label for="Monday">Monday</label><br>
	<input type="radio" id="Tuesday" name="day" value="Tuesday">
  	<label for="Tuesday">Tuesday</label><br>
	<input type="radio" id="Wednesday" name="day" value="Wednesday">
  	<label for="Wednesday">Wednesday</label><br>
	<input type="radio" id="Thursday" name="day" value="Thursday">
  	<label for="Thursday">Thursday</label><br>
	<input type="radio" id="Friday" name="day" value="Friday">
  	<label for="Friday">Friday</label><br>
	<input type="radio" id="Saturday" name="day" value="Saturday">
  	<label for="Saturday">Saturday</label><br>
	<input type="radio" id="Sunday" name="day" value="Sunday">
  	<label for="Sunday">Sunday</label><br><br>	
	<h5>Airline</h5>
	<?php
		$result = $connection->query("select * from airline");
		while ($row = $result->fetch()) {
		echo '<input type="radio" name="availableAirlines" value="';
		echo $row["AirlineCode"];
		echo '">' . "Airline Name: " . $row["Name"]  . ", Airline Code: " . $row["AirlineCode"] . "<br>";
		}
	?>
	<input type="submit" value="Customize Search">
	</form>

	<h2>Add a New Flight</h2>
	<p>Click below to be taken to a new page where you can add a new flight to our database.</p>
	<button onclick="window.location.href='/addFlightPage.php';">
      		Add a flight
    	</button>

	<h2>Update a Flight's Departure Time</h2>
	<p>Please select the flight for which you would like to update the actual departure time.</p>
<form action="/updateDepartureTime.php" method = "post">
<?php
$result = $connection->query("select * from flight");
while ($row = $result->fetch()) {
	$sched = $row["SchedDepart"];
	$actual = $row["ActualDepart"];
	if (empty($row["SchedDepart"])) {
		$sched = "no data";
	}
	if (empty($row["ActualDepart"])) {
		$actual = "no data";
	}
	echo '<input type="radio" name="deptTimes" value="';
	echo $row["FlightNum"];
	echo '">' . "Flight Number: " . $row["FlightNum"]  . ", Scheduled Departure Time: " . $sched . ", Current Actual Departure Time: " . $actual . "<br>";
}
?>
<p>Please enter the updated time in the form of HOUR:MINUTE:SECOND.</p>
<input name="hour" id="hour" type="number" value="0"  min="0" max="23">
<input name="minute" id="minute" type="number" value="0"  min="0" max="59">
<input name="second" id="second" type="number" value="0"  min="0" max="59"><br><br>
<input type="submit" value="Select Flight">
</form>
	
	<h2>Average Daily Seat Availability</h2>
	<p>Select a day of the week to see the average number of available seats from all flights for that day:</p>
	<form action="avgDailySeats.php" method="POST">
  	<input type="radio" id="Monday" name="day" value="Monday">
  	<label for="Monday">Monday</label><br>
	<input type="radio" id="Tuesday" name="day" value="Tuesday">
  	<label for="Tuesday">Tuesday</label><br>
	<input type="radio" id="Wednesday" name="day" value="Wednesday">
  	<label for="Wednesday">Wednesday</label><br>
	<input type="radio" id="Thursday" name="day" value="Thursday">
  	<label for="Thursday">Thursday</label><br>
	<input type="radio" id="Friday" name="day" value="Friday">
  	<label for="Friday">Friday</label><br>
	<input type="radio" id="Saturday" name="day" value="Saturday">
  	<label for="Saturday">Saturday</label><br>
	<input type="radio" id="Sunday" name="day" value="Sunday">
  	<label for="Sunday">Sunday</label><br><br>	
	<input type="submit" value="Submit">
	</form>

</body>
</html>
