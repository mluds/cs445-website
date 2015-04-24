<?php

session_start();

if ($_SESSION['email'] !== 'admin') {
    die();
}

$conn = new mysqli("cs445sql", "mdludwig", "EL104mdl", "FLP");
if ($conn->connect_error) {
    die();
}

$result = $conn->query($_POST['query']);

?>

<?php if ($result === true): ?>
Success
<?php elseif ($result === false): ?>
Failure
<?php else: ?>
    <table class="table">
        <thead>
	    <tr>
	        <?php foreach ($result->fetch_fields() as $field): ?>
		    <th><?php echo $field->name; ?></th>
		<?php endforeach; ?>    
	    </tr>
	</thead>
	<tbody>
	    <?php while ($row = $result->fetch_assoc()): ?>
	        <tr>
		    <?php foreach ($row as $value): ?>
		        <td><?php echo $value; ?></td>
		    <?php endforeach; ?>
		</tr>
	    <?php endwhile; ?>
	</tbody>
    </table>
<?php endif; ?>