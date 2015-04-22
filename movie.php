<!doctype html>
<html>
<head>
<title>MOVIES !!!!!</title>
</head>
<body>
	<?php include 'header.php';?>

	<?php
	$servername = 'cs445sql';
	$username = 'pfeil';
	$password = 'EL859pfe';
	$dbname = "FLP";

	// Create  Connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check Connection
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Setup Queries
	$sql = "SELECT * FROM movies m, mpaa_ratings r WHERE m.id = " . $_GET["id"] . " and m.rid=r.id";
	$actors = "SELECT p.id, p.name, ma.role FROM movies m, movies_actors ma, actors a, people p WHERE m.id = " . $_GET["id"] . " and m.id=ma.mid and ma.aid=a.id and a.pid=p.id ORDER BY p.name";
	$directors = "SELECT p.id, p.name FROM movies m, movies_directors md, directors d, people p WHERE m.id = " . $_GET["id"] . " and m.id=md.mid and md.did=d.id and d.pid=p.id ORDER BY p.name";
	$producers = "SELECT p.id, p.name FROM movies m, movies_producers mr, producers r, people p WHERE m.id = " . $_GET["id"] . " and m.id=mr.mid and mr.pid=r.id and r.pid=p.id ORDER BY p.name";

	// Output Movie Information
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$movie = $result->fetch_assoc();
		echo "<h3>" . $movie["title"] . " (" . $movie["year"] . ")</h3><br>";
		echo "MPAA-Rating: " . $movie["rating"] . "<br>";
		echo "Average User Rating: " . $movie["avg_rating"] . "<br>";
		echo "Number of User Ratings: " . $movie["num_ratings"] . "<br><br>";
		$result->close();
	} 
	?>

	<?php if(0 == 0) : ?>
	<form>
		Your Rating: <br>
		Rate This Movie: 
		<select name='rating'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
			<option value='5'>5</option>
			<option value='6'>6</option>
			<option value='7'>7</option>
			<option value='8'>8</option>
			<option value='9'>9</option>
			<option value='10'>10</option>
		</select>
		<button type='submit' class='btn btn-primary'>Rate!</button><br>
	</form>
	<?php endif; ?>

	<?php
	// Output Movie Director Information
	$result = $conn->query($directors);
	if($result) {
		echo "<h4>Directors: </h4>";
		while($row = $result->fetch_assoc()) {
			echo "<a href='people.php?id=" . $row["id"] . "'>" . $row["name"] . "</a><br>";
		}
		echo "<br>";
		$result->close();
	}

	// Output Movie Producer Information
	$result = $conn->query($producers);
	if($result) {
		echo "<h4>Producers: </h4>";
		while($row = $result->fetch_assoc()) {
			echo "<a href='people.php?id=" . $row["id"] . "'>" . $row["name"] . "</a><br>";
		}
		echo "<br>";
		$result->close();
	}


	// Output Movie Actor Information
	$result = $conn->query($actors);
	if($result) {
		echo "<h4>Actors: </h4>";
		while($row = $result->fetch_assoc()) {
			echo "<a href='people.php?id=" . $row["id"] . "'>" . $row["name"] . " (" . $row["role"] . ")</a><br>";
		}
		echo "<br>";
		$result->close();
	}

	$conn->close();
	?>

</body>
</html>