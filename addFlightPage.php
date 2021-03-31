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
	
	<script>
	function reloadPage() {
		location.reload();
	}
	</script>


	<h1>Add a Flight</h1>

		<h2>List of Flights</h2>
		<?php
			$result = $connection->query("select * from flight");
			echo "<ol>";
			while ($row = $result->fetch()) {
			echo "<li>";
			echo "Flight Number: " . $row["FlightNum"] ."</li>";
		}
		echo "</ol>";
		?>

	<button onclick="reloadPage()">
      		Refresh List
    	</button>

	<h2>Add a New Flight</h2>
	<form action = "addFlightPage.php" method = "post" name = "addflight">
	<p>Please select an airline from the following list of available airlines:</p>
	<?php
   		include 'getAirlines.php';
	?>
	<p>Please select a departure airport from the following list of open airports:</p>
	<?php
   		$query = "SELECT * FROM airport";
   		$result = $connection->query($query);
   		while ($row = $result->fetch()) {
        		echo '<input type="radio" name="deptAirports" value="';
			echo $row["AirportCode"];
        		echo '">' . $row["Name"] . "<br>";
   		}
	?>
	<p>Please select an arrival airport from the following list of open airports:</p>
	<?php
   		$query = "SELECT * FROM airport";
   		$result = $connection->query($query);
   		while ($row = $result->fetch()) {
        		echo '<input type="radio" name="arrAirports" value="';
			echo $row["AirportCode"];
        		echo '">' . $row["Name"] . "<br>";
   		}
	?>

	<p>Please select which day(s) of the week this flight will be offered:</p> 
	<input type="checkbox" id="monday" name="day[]" value="Monday">
  	<label for="monday"> Monday</label><br>
	<input type="checkbox" id="Tuesday" name="day[]" value="Tuesday">
  	<label for="Tuesday"> Tuesday</label><br>
	<input type="checkbox" id="Wednesday" name="day[]" value="Wednesday">
  	<label for="Wednesday"> Wednesday</label><br>
	<input type="checkbox" id="Thursday" name="day[]" value="Thursday">
  	<label for="Thursday"> Thursday</label><br>
	<input type="checkbox" id="Friday" name="day[]" value="Friday">
  	<label for="Friday"> Friday</label><br>
	<input type="checkbox" id="Saturday" name="day[]" value="Saturday">
  	<label for="Saturday"> Saturday</label><br>
	<input type="checkbox" id="Sunday" name="day[]" value="Sunday">
  	<label for="Sunday"> Sunday</label><br>

	<p>Please enter your flight's 3-digit flight number:</p> 
	<input name = "flightnum1" type="number" value="0"  min="0" max="9">
	<input name = "flightnum2" type="number" value="0"  min="0" max="9">
	<input name = "flightnum3" type="number" value="0"  min="0" max="9"><br><br>


	<p>Please enter your flight's schedule departure time in the form of HOUR:MINUTE:SECOND.</p>
	<input name="dephour" id="hour" type="number" value="0"  min="0" max="23">
	<input name="depminute" id="minute" type="number" value="0"  min="0" max="59">
	<input name="depsecond" id="second" type="number" value="0"  min="0" max="59"><br><br>
	
	<p>Please enter your flight's schedule arrival time in the form of HOUR:MINUTE:SECOND.</p>
	<input name="arrhour" id="hour" type="number" value="0"  min="0" max="23">
	<input name="arrminute" id="minute" type="number" value="0"  min="0" max="59">
	<input name="arrsecond" id="second" type="number" value="0"  min="0" max="59"><br><br>
	<input type="submit" name="submit" value="Enter New Flight" onClick = "clearform()">
	</form>

	<?php
	if(isset($_POST["submit"])) {
   		$airline = $_POST["availableAirlines"];
		$departingAirport = $_POST["deptAirports"];
		$arrivingAirport = $_POST["arrAirports"];
		$whichday = $_POST["day"];
		$num1 = $_POST['flightnum1'];
		$num2 = $_POST['flightnum2'];
		$num3 = $_POST['flightnum3'];
		$flightnumber = $airline . $num1 . $num2 . $num3;
		$dephour = $_POST['dephour'];
		$depminute = $_POST['depminute'];
		$depsecond = $_POST['depsecond'];
		$deptime = $dephour . ":" . $depminute . ":" . $depsecond;
		$arrhour = $_POST['arrhour'];
		$arrminute = $_POST['arrminute'];
		$arrsecond = $_POST['arrsecond'];
		$arrtime = $arrhour . ":" . $arrminute . ":" . $arrsecond;
		$sql1 = 'SELECT Id FROM airplane WHERE AirlineCode = "' . $airline . '" ';
		$result = $connection->query($sql1);
		$airplaneid = "null";
		if ($row = $result->fetch()) {
			$airplaneid = $row["Id"];
		}
		$sql2 = 'INSERT INTO flight VALUES("' . $flightnumber . '", "' . $airline . '", "' . $airplaneid . '", "' . $arrivingAirport . '", "' . $arrtime . '", null, "' . $departingAirport . '", "' . $deptime . '", null)';
		if ($airplaneid != "null") {
			$sql4 = 'SELECT FlightNum FROM flight WHERE FlightNum = "' . $flightnumber . '" ';
			$value = $connection->query($sql4);
			if (!($row = $value->fetch())) {
				$numRows = $connection->exec($sql2);
			}
		}
		
		if(isset($_POST['day'])){
  			if (is_array($_POST['day'])) {
    				foreach($_POST['day'] as $value){
					$sql3 = 'INSERT INTO flightdays VALUES("' . $value . '", "' . $flightnumber . '") ';
					$sql4 = 'SELECT FlightNum FROM flightdays WHERE FlightNum = "' . $flightnumber . '" AND Day = "' . $value . '"';
					$value = $connection->query($sql4);
					if (!($row = $value->fetch())) {
						$numRows2 = $connection->exec($sql3);
					}
				}
  			} 
			else {
    				$value = $_POST['day'];
    				$sql3 = 'INSERT INTO flightdays VALUES("' . $value . '", "' . $flightnumber . '") ';
				$numRows2 = $connection->exec($sql3);
  			}
		}
	}
	?>

	<p>Click below to return to the home page.</p>
	<button onclick="window.location.href='/airline.php';">
      		Return to home page
    	</button>

</body>
</html>
