<?php

include('header.php');

// Create connection
$conn = new mysqli('cs445sql', 'pfeil', 'EL859pfe', 'FLP');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Output the user information
$sql = "SELECT * FROM users u WHERE u.id = " . $_GET["id"];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h3>" . $row["name"] . "</h3><br>";
    echo "Email: " . $row["email"] . "<br>";
    echo "Age: " . $row["age"] . "<br>";
    echo "Gender: " . $row["gender"] . "<br>";
    echo "Locaiton: " . $row["location"] . "<br>";
    $result->close();
} 

$conn->close();

include('footer.php');

?>
