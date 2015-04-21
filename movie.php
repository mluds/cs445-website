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
	$actors = "SELECT p.id, p.name, ma.role FROM movies m, movies_actors ma, actors a, people p WHERE m.id = " . $_GET["id"] . " and m.id=ma.mid and ma.aid=a.id and a.pid=p.id";
	$directors = "SELECT p.id, p.name FROM movies m, movies_directors md, directors d, people p WHERE m.id = " . $_GET["id"] . " and m.id=md.mid and md.did=d.id and d.pid=p.id";
	$producers = "SELECT p.id, p.name FROM movies m, movies_producers mr, producers r, people p WHERE m.id = " . $_GET["id"] . " and m.id=mr.mid and mr.pid=r.id and r.pid=p.id";

	// Output Movie Information
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		echo "<h3>" . $row["title"] . " (" . $row["year"] . ")</h3><br>";
		echo "Rating: " . $row["rating"] . "<br>";
		echo "Average User Rating: " . $row["avg_rating"] . "<br>";
		echo "Number of User Ratings: " . $row["num_ratings"] . "<br><br>";
		$result->close();
	} 

	// Out Movie Director Information
	$result = $conn->query($directors);
	if($result) {
		echo "Directors: <br>";
		while($row = $result->fetch_assoc()) {
			echo "<a href='people.php?id=" . $row["id"] . "'>" . $row["name"] . "</a><br>";
		}
		echo "<br>";
		$result->close();
	}

	// Out Movie Actor Information
	$result = $conn->query($producers);
	if($result) {
		echo "Producers: <br>";
		while($row = $result->fetch_assoc()) {
			echo "<a href='people.php?id=" . $row["id"] . "'>" . $row["name"] . "</a><br>";
		}
		echo "<br>";
		$result->close();
	}


	// Out Movie Actor Information
	$result = $conn->query($actors);
	if($result) {
		echo "Actors: <br>";
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