<!doctype html>
<html>
<head>
<title>Results</title>
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

	// Check COnnection
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Setup Display
	if($_GET["option"] == "movies") 		{ $page_name = "movie.php"; 	$output = "title";		$outputtwo = "year";		}		
	if($_GET["option"] == "users") 			{ $page_name = "user.php"; 		$output = "name";		$outputtwo = "";			}	
	if($_GET["option"] == "actors") 		{ $page_name = "people.php";	$output = "name";		$outputtwo = "";			}
	if($_GET["option"] == "directors") 		{ $page_name = "people.php";	$output = "name";		$outputtwo = "";			}	
	if($_GET["option"] == "producers")		{ $page_name = "people.php";	$output = "name";		$outputtwo = "";			}

	// Create the query based on what database we are searching from
	if($_GET["option"] == "movies") 		$sql = "SELECT * FROM movies m WHERE LOWER(m.title) like LOWER('%" . $_GET["search"] . "%')";
	if($_GET["option"] == "users") 			$sql = "SELECT * FROM users u WHERE LOWER(u.name) like LOWER('%" . $_GET["search"] . "%') or LOWER(u.email) like LOWER('%" . $_GET["search"] . "%')";
	if($_GET["option"] == "actors") 		$sql = "SELECT * FROM actors a, people p WHERE a.pid = p.id and LOWER(p.name) like LOWER('%" . $_GET["search"] . "%')";
	if($_GET["option"] == "directors") 		$sql = "SELECT * FROM directors d, people p WHERE d.pid = p.id and LOWER(p.name) like LOWER('%" . $_GET["search"] . "%')";
	if($_GET["option"] == "producers") 		$sql = "SELECT * FROM producers r, people p WHERE r.pid = p.id and LOWER(p.name) like LOWER('%" . $_GET["search"] . "%')";


	// Output results of the query
	$result = $conn->query($sql);
	echo "Number of Search Results: " . $result->num_rows . "<br>";
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<a href='" . $page_name . "?id=" . $row["id"] . "'>" . $row[$output];
			if ($outputtwo != "") echo " (" . $row[$outputtwo] . ")";
			echo "</a><br>";
		}
		$result->close();
	}

	// Close the connection
	$conn->close();
	?>


</body>
</html>