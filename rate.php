<?php
session_start();

// Create connection
$conn = new mysqli('cs445sql', 'pfeil', 'EL859pfe', 'FLP');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ratings r WHERE r.uid=" . $_SESSION['id'] . " and r.mid=" . $_POST['mid'];
$movie = "SELECT m.avg_rating, m.num_ratings FROM movies m WHERE m.id=" . $_POST['mid'];
$update_rating = "UPDATE ratings r SET r.rating =" . $_POST['rating'] . " WHERE r.uid=" . $_SESSION['id'] . " and r.mid=" . $_POST['mid'];
$insert = "INSERT INTO ratings (uid, mid, rating) value(" . $_SESSION['id'] . ", " . $_POST['mid'] . ", " . $_POST['rating'] . ")";

// Query Movie
$result = $conn->query($movie);
if($result->num_rows > 0) {

	// Movie Rating Info
	$row = $result->fetch_assoc();
	$num_ratings = $row['num_ratings'];
	$avg_rating = $row['avg_rating'];

	// Close Connection, Start new Query
	$result->close();
	$result = $conn->query($sql);

	// Update
	if ($result->num_rows > 0) {
		$old_rating = $result->fetch_assoc();
		$old_rating = $old_rating['rating'];

		// Calculate Average
		$avg_rating = (($avg_rating * $num_ratings) -  $old_rating + $_POST['rating']) / $num_ratings;

		// Update Rating
		$update_movie = "UPDATE movies m SET m.avg_rating=" . $avg_rating . " WHERE m.id=" . $_POST['mid'];

		$conn->query($update_movie);
		$conn->query($update_rating);
		$result->close();
	}
	// Insert
	else {
		$num_ratings = $num_ratings + 1;
		$avg_rating = (($avg_rating * ($num_ratings - 1)) + $_POST['rating']) / ($num_ratings);

		// Update Ratring
		$update_movie = "UPDATE movies m SET m.avg_rating=" . $avg_rating . ", m.num_ratings=" . $num_ratings . " WHERE m.id=" . $_POST['mid'];

		$conn->query($update_movie);
		$conn->query($insert);
	}

	echo $update_movie;

}

header("Location: http://cs445.cs.umass.edu" . $_POST['back']);
$conn->close();
die();
?>