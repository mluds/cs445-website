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
$user = null;
$friend_rec = "SELECT u2.id, u2.name FROM users u1, users u2, ratings r1, ratings r2 WHERE u1.id=" . $_SESSION['id'] . " AND u1.id<>u2.id AND u1.location=u2.location AND u1.id=r1.uid AND u2.id=r2.uid AND r1.mid=r2.mid AND r1.rating=r2.rating ORDER BY rand() LIMIT 5";
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $result->close();
}


$friends = $conn->query("SELECT u.id,u.name FROM users u, friends f WHERE f.uid1=" . $_GET['id'] . " and f.uid2=u.id");

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
    Locaiton: <?php echo $user["location"]; ?><br><br>
    <?php if ($friends->num_rows > 0): ?>
        <h3>Friends</h3>
        <?php while ($friend = $friends->fetch_assoc()): ?>
	    <a href="user.php?id=<?php echo $friend['id']; ?>"><?php echo $friend['name']; ?></a><br>
	<?php endwhile; ?>
    <? else: ?>
    You don't have any friends.
    <? endif; ?>
    <?php
        $result = $conn->query($friend_rec);
        if($result->num_rows > 0 and isset($_SESSION['id']) and $user['id'] == $_SESSION['id']) {
            echo "<h3>Recommended Friends: </h3>";
            while ($row = $result->fetch_assoc()) {
                echo "<a href=user.php?id=" . $row['id'] . ">" . $row['name'] . "<br>";
            }
            $result->close();
        }
    ?>
<?php else: ?>
    Could not find user
<?php endif; ?>
<?php $conn->close(); ?>
<?php include('footer.php'); ?>
