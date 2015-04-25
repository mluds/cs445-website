
<?php

include('header.php');

function addConstraint($clause, $constraint) {
    if($clause != "") {
        $clause .= " and ";
    }
    else {
        $clause .= " WHERE ";
    }
    $clause .= $constraint;
    return $clause;
}

// Create connection
$conn = new mysqli('cs445sql', 'pfeil', 'EL859pfe', 'FLP');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build Query
$movie = "SELECT DISTINCT p.id, p.name ";
$from = "FROM people p, actors a";
$clause = "";

// Check if we add movies
if($_GET["mpaa-rating"] != "Any" || $_GET["year-min"] != "" || $_GET["year-max"] != "" || $_GET["num-movies-min"] != "" || $_GET["num-movies-max"] != "") {
    $from .= ", movies m, movies_actors ma";
    $clause = addConstraint($clause, "m.id=ma.mid and a.id=ma.aid and p.id=a.pid");
}

// Check Actor
if ($_GET["name"] != "") {
    $clause = addConstraint($clause, "LOWER(p.name) like LOWER('%" . $_GET["name"] . "%')");
}

// Check Year
if ($_GET["year-min"] != "") {
    $clause = addConstraint($clause, "m.year>=" . $_GET["year-min"]);
}
if ($_GET["year-max"] != "") {
    $clause = addConstraint($clause, "m.year<=" . $_GET["year-max"]);
}

// Check MPAA-Ratings
if ($_GET["mpaa-rating"] != "Any") {
    $from .= ", mpaa_ratings mp";
    if ($_GET["mpaa-rating"] == "Rated") {
        $clause = addConstraint($clause, "m.rid is not NULL");
    }
    else if ($_GET["mpaa-rating"] == "Unrated") {
        $clause = addConstraint($clause, "m.rid is NULL");
    }
    else {
        $clause = addConstraint($clause, "m.rid=mp.id");
        $clause = addConstraint($clause, "mp.rating='" . $_GET["mpaa-rating"] . "'");
    }
}

// Check Number of Movies
if ($_GET["num-movies-min"] != "" || $_GET["num-movies-max"] != "") {
    $clause .= " GROUP BY p.id HAVING ";
    if ($_GET["num-movies-min"] != "" && $_GET["num-movies-max"] != "") {
        $clause .= "count(m.id)>=" . $_GET["num-movies-min"] . " and count(m.id)<=" . $_GET["num-movies-max"];
    }
    else if ($_GET["num-movies-min"] != "") {
        $clause .= "count(m.id)>=" . $_GET["num-movies-min"];
    }
    else if ($_GET["num-movies-max"] != "") {
        $clause .= "count(m.id)<=" . $_GET["num-movies-max"];
    }
}
$movie = $movie . $from . $clause;
echo $movie . "<br>";

// Output results of the query
$result = $conn->query($movie);
if ($result->num_rows > 0) {
    echo "<h4>Number of Search Results: " . $result->num_rows . "</h4>>";
    while($row = $result->fetch_assoc()) {
        echo "<a href='people.php?id=" . $row["id"] . "'>" . $row["name"] . "</a><br>";
    }
    $result->close();
}
else {
    echo "<h4>Number of Search Results: 0</h4>";
}

// Close the connection
$conn->close();
include('sidebar.php');
include('footer.php');

?>
