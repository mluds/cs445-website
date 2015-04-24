<?php

session_start();

// Create connection
$conn = new mysqli('cs445sql', 'pfeil', 'EL859pfe', 'FLP');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$get = "SELECT * FROM friends f WHERE f.uid1=" . $_SESSION['id'] . " and f.uid2=" . $_POST['id'];

$result = $conn->query($get);

if ($result->num_rows == 0) {
    $conn->query("INSERT INTO friends (uid1,uid2) VALUE(" . $_SESSION['id'] . "," . $_POST['id'] . ")");
}

header("Location: http://cs445.cs.umass.edu" . $_POST['back']);

?>