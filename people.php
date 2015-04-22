<?php

include('header.php');

// Create connection
$conn = new mysqli('cs445sql', 'pfeil', 'EL859pfe', 'FLP');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Setup our SQL queries
$sql = "SELECT * FROM people p WHERE p.id = " . $_GET["id"];
$acted = "SELECT m.id, m.title FROM people p, actors a, movies_actors ma, movies m WHERE p.id =" . $_GET["id"] ." and p.id=a.pid and a.id=ma.aid and ma.mid=m.id";
$directed = "SELECT m.id, m.title FROM people p, directors d, movies_directors md, movies m WHERE p.id =" . $_GET["id"] ." and p.id=d.pid and d.id=md.did and md.mid=m.id";
$produced = "SELECT m.id, m.title FROM people p, producers r, movies_producers mr, movies m WHERE p.id =" . $_GET["id"] ." and p.id=r.pid and r.id=mr.pid and mr.mid=m.id";

// Output the person's name
$result = $conn->query($sql);
if ($result) {
	$row = $result->fetch_assoc();
	echo "<h3>" . $row["name"] . "</h3><br>";
	$result->close();
}

// Output the movies they have acted in
$result = $conn->query($acted);
if($result) {
	echo "<h4>Movies Acted in: </h4>";
	while($row = $result->fetch_assoc()) {
		echo "<a href='movie.php?id=" . $row["id"] . "'>" . $row["title"] . "</a><br>";
	}
	echo "<br>";
	$result->close();
}

// Output the movies they have directed
$result = $conn->query($directed);
if($result->num_rows > 0) {
	echo "<h4>Movies Directed: </h4>";
	while($row = $result->fetch_assoc()) {
		echo "<a href='movie.php?id=" . $row["id"] . "'>" . $row["title"] . "</a><br>";
	}
	echo "<br>";
	$result->close();
}

// Output the movies they have Produced
$result = $conn->query($produced);
if($result->num_rows > 0) {
	echo "<h4>Movies Produced: </h4>";
	while($row = $result->fetch_assoc()) {
		echo "<a href='movie.php?id=" . $row["id"] . "'>" . $row["title"] . "</a><br>";
	}
	echo "<br>";
	$result->close();
}

$conn->close();

include('footer.php');

?>
