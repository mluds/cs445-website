<?php include('header.php'); ?>

<?php if (isset($_SESSION['email']) and $_SESSION['email'] === 'admin'): ?>
    
<div class="page-header"><h3>SQL Query Interface</h3></div>
<form id="query" method="post">
    <div class="form-group"><code><textarea name="query" rows="10" cols="100"></textarea></code></div>
    <div class="form-group"><button type="submit" class="btn btn-primary">Execute</button></div>
</form>
<div id="result"></div>
</div>
<?php include('scripts.php'); ?>
<script>
$('#query').submit(function(event) {
    event.preventDefault();
    $.post('execute.php', $('#query').serialize(), function(data) {
        $('#result').html(data);
    });
});
</script>
</body>
</html>

<?php else: ?>

You don't have permission to view this page.
<?php include('footer.php'); ?>

<?php endif; ?>
