<?php

include('header.php');

// Create connection
$conn = new mysqli('cs445sql', 'pfeil', 'EL859pfe', 'FLP');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Setup display
$op = $_GET['option'];
if ($op == "movies") {
    $page_name = "movie.php";
    $output = "title";
    $outputtwo = "year";
    $sql = "SELECT * FROM movies m WHERE LOWER(m.title) like LOWER('%" . $_GET["search"] . "%')";
} elseif ($op == "users") {
    $page_name = "user.php";
    $output = "name";
    $outputtwo = "";
    $sql = "SELECT * FROM users u WHERE LOWER(u.name) like LOWER('%" . $_GET["search"] . "%') or LOWER(u.email) like LOWER('%" . $_GET["search"] . "%')";
} elseif ($op == "actors" or $op == "directors" or $op == "producers") {
    $page_name = "people.php";
    $output = "name";
    $outputtwo = "";
}

// Create the query based on what database we are searching from        
if ($op == "actors") {
    $sql = "SELECT * FROM actors a, people p WHERE a.pid = p.id and LOWER(p.name) like LOWER('%" . $_GET["search"] . "%')";
} elseif ($op == "directors") {
    $sql = "SELECT * FROM directors d, people p WHERE d.pid = p.id and LOWER(p.name) like LOWER('%" . $_GET["search"] . "%')";
} elseif ($op == "producers") {
    $sql = "SELECT * FROM producers r, people p WHERE r.pid = p.id and LOWER(p.name) like LOWER('%" . $_GET["search"] . "%')";
}

// Output results of the query
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h4>Number of Search Results: " . $result->num_rows . "</h4>";
    while ($row = $result->fetch_assoc()) {
        echo "<a href='" . $page_name . "?id=" . $row["id"] . "'>" . $row[$output];
        if ($outputtwo != "") {
            echo " (" . $row[$outputtwo] . ")";
        }
        echo "</a><br>";
    }
    $result->close();
} else {
    echo "<h4>Number of Search Results: 0</h4>";
}

// Close the connection
$conn->close();

include('footer.php');

?>
