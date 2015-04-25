</div> <!-- End MainCol -->
<?php
// Create connection
$conn = new mysqli('cs445sql', 'pfeil', 'EL859pfe', 'FLP');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<div class="col-md-3" id="rightCol">
	<?php if(isset($_SESSION['id'])) : ?>
		<!-- Recent Updates -->
		<div class="panel panel-default">
			<div class="panel-heading">Recent Updates </div>
			<div class="panel-body">
				<ul class="nav nav-stacked" id="updates">
				
				</ul>
			</div>
		</div>
		<!-- Recommended Friends -->
		<div class="panel panel-default">
			<div class="panel-heading">Recommended Friends</div>
			<div class="panel-body">
				<ul class="nav" id="rec_friends">
				    <?php
				    	$friend_rec = "SELECT u2.id, u2.name FROM users u1, users u2, ratings r1, ratings r2 WHERE u1.id=" . $_SESSION['id'] . " AND u1.id<>u2.id AND u1.location=u2.location AND u1.id=r1.uid AND u2.id=r2.uid AND r1.mid=r2.mid AND r1.rating=r2.rating ORDER BY rand() LIMIT 5";
				    	$result = $conn->query($friend_rec);
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								echo "<li><a href=user.php?id=" . $row['id'] . ">" . $row['name'] . "</a></li>";
							}
							$result->close();
						}
				    ?>
				</ul>
			</div>
		</div>
	<?php endif ?>
<?php $conn->close(); ?>