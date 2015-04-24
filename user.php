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
$conn->close();
$user = null;
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
}
$result->close();

?>

<?php if ($user !== null): ?>
    <h3><?php echo $user['name']; ?></h3><br>
    <?php if (isset($_SESSION['id']) and $user['id'] != $_SESSION['id']): ?>
        <form action="friend.php" method="post">
	    <input name="id" value="<?php echo $_GET['id']; ?>" hidden>
	    <input name="back" value="<?php echo $_SERVER['REQUEST_URI']; ?>" hidden>
	    <button type="submit" class="btn btn-primary">Add</button>
	</form>
    <?php endif; ?>
    Email: <?php echo $user["email"]; ?><br>
    Age: <?php echo $user["age"]; ?><br>
    Gender: <?php echo $user["gender"]; ?><br>
    Locaiton: <?php echo $user["location"]; ?>
<?php else: ?>
    Could not find user
<?php endif; ?>

<?php include('footer.php'); ?>
