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

// Build FROM clause
$movie = "SELECT DISTINCT m.id, m.title, m.year ";
$from = "FROM movies m";
$clause = "";

// Check Title
if ($_GET["title"] != "") {
    $clause = addConstraint($clause, "LOWER(m.title) like LOWER('%" . $_GET["title"] . "%')");
}

// Check Year
if ($_GET["year-min"] != "") {
    $clause = addConstraint($clause, "m.year>=" . $_GET["year-min"]);
}
if ($_GET["year-max"] != "") {
    $clause = addConstraint($clause, "m.year<=" . $_GET["year-max"]);
}

// Check Avg
if ($_GET["avg-min"] != "") {
    $clause = addConstraint($clause, "m.avg_rating>=" . $_GET["avg-min"]);
}
if ($_GET["avg-max"] != "") {
    $clause = addConstraint($clause, "m.avg_rating<=" . $_GET["avg-max"]);
}

// Check number of ratings
if ($_GET["num-rating-min"] != "") {
    $clause = addConstraint($clause, "m.num_ratings>=" . $_GET["num-rating-min"]);
}
if ($_GET["num-rating-max"] != "") {
    $clause = addConstraint($clause, "m.num_ratings<=" . $_GET["num-rating-max"]);
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

// Check Actors
if($_GET["actor"] != "") {
    $from .= ", movies_actors ma, actors a, people p";
    $clause = addConstraint($clause, "m.id=ma.mid and a.id=ma.aid and p.id=a.pid");
    $clause = addConstraint($clause, "LOWER(p.name) like LOWER('%" . $_GET["actor"] . "%')");
}

$clause .= " ORDER BY m.avg_rating DESC";
if($_GET["amount-movies"] != "") {
    $clause .= " LIMIT " . $_GET["amount-movies"];
}
$movie = $movie . $from . $clause;

// Output results of the query
$result = $conn->query($movie);
if ($result->num_rows > 0) {
    echo "<h4>Number of Search Results: " . $result->num_rows . "</h4>";
    while($row = $result->fetch_assoc()) {
        echo "<a href='movie.php?id=" . $row["id"] . "'>" . $row["title"] . " (" . $row["year"] . ")</a><br>";
    }
    $result->close();
}
else {
    echo "<h4>Number of Search Results: 0</h4>";
}

// Close the connection
$conn->close();

include('footer.php');

?>
