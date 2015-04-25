<?php

include('header.php');

// Create connection
$conn = new mysqli('cs445sql', 'pfeil', 'EL859pfe', 'FLP');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Setup queries
$sql = "SELECT * FROM movies m WHERE m.id = " . $_GET["id"];
$mpaa = "SELECT r.rating FROM movies m, mpaa_ratings r WHERE m.id = " . $_GET["id"] . " and m.rid=r.id";
$actors = "SELECT p.id, p.name, ma.role FROM movies m, movies_actors ma, actors a, people p WHERE m.id = " . $_GET["id"] . " and m.id=ma.mid and ma.aid=a.id and a.pid=p.id ORDER BY p.name";
$directors = "SELECT p.id, p.name FROM movies m, movies_directors md, directors d, people p WHERE m.id = " . $_GET["id"] . " and m.id=md.mid and md.did=d.id and d.pid=p.id ORDER BY p.name";
$producers = "SELECT p.id, p.name FROM movies m, movies_producers mr, producers r, people p WHERE m.id = " . $_GET["id"] . " and m.id=mr.mid and mr.pid=r.id and r.pid=p.id ORDER BY p.name";

// Output movie information
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$movie = $result->fetch_assoc();
	echo "<h3>" . $movie["title"] . " (" . $movie["year"] . ")</h3><br>";

	// MPAA-Rating Bullshit
	if(!$movie['rid'] == null) {
		$mresult = $conn->query($mpaa);
		if ($mresult->num_rows > 0) {
			$mrating = $mresult->fetch_assoc();
			echo "MPAA-Rating: " . $mrating["rating"] . "<br>";
			$mresult->close();
		}
	}
	echo "Average User Rating: " . $movie["avg_rating"] . "<br>";
	echo "Number of User Ratings: " . $movie["num_ratings"] . "<br><br>";
	$result->close();
}

// Get current user for our session
$rating = null;
if (isset($_SESSION['id'])) {
	$rquery = "SELECT r.rating FROM ratings r WHERE r.uid=" . $_SESSION['id'] . " and r.mid=" . $_GET['id'];
	$result = $conn->query($rquery);
	if ($result->num_rows > 0) {
		$rating = $result->fetch_assoc();
		$result->close();
	}
}
?>

<?php if (isset($_SESSION['id'])): ?>
<form method="post" action="rate.php">
    <input name="mid" value="<?php echo $_GET['id']; ?>" hidden>
    <input name="back" value="<?php echo $_SERVER['REQUEST_URI']; ?>" hidden>
	<?php if(!$rating==null)
	{
		echo "Your Rating: " . $rating['rating'];
	} 
	else 
	{
		echo "You've not rated this movie!";
	}
	?><br>
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
if ($result) {
	echo "<h4>Directors: </h4>";
	while($row = $result->fetch_assoc()) {
		echo "<a href='people.php?id=" . $row["id"] . "'>" . $row["name"] . "</a><br>";
	}
	echo "<br>";
	$result->close();
}

// Output movie producer information
$result = $conn->query($producers);
if ($result) {
	echo "<h4>Producers: </h4>";
	while($row = $result->fetch_assoc()) {
		echo "<a href='people.php?id=" . $row["id"] . "'>" . $row["name"] . "</a><br>";
	}
	echo "<br>";
	$result->close();
}

// Output movie actor information
$result = $conn->query($actors);
if ($result) {
	echo "<h4>Actors: </h4>";
	while($row = $result->fetch_assoc()) {
		echo "<a href='people.php?id=" . $row["id"] . "'>" . $row["name"] . " (" . $row["role"] . ")</a><br>";
	}
	echo "<br>";
	$result->close();
}

$conn->close();

include('sidebar.php');
include('footer.php');

?>