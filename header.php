<link rel="stylesheet" type="text/css" href="http://code.divshot.com/geo-bootstrap/swatch/bootstrap.min.css">

<style>
.header img {
       float: left;
}
</style>

<img src="http://code.divshot.com/geo-bootstrap/img/test/mchammer.gif" style="float: left" />
<img src="http://code.divshot.com/geo-bootstrap/img/test/mchammer.gif" style="float: left" />
<img src="http://code.divshot.com/geo-bootstrap/img/test/mchammer.gif" style="float: left" />
<h2 style="float: left">MOVIE DATABASE</h2>
<img src="http://code.divshot.com/geo-bootstrap/img/test/new2.gif" style="float: left" />

<!-- Login / Register -->
<form>
	Username: <input type="text" name="user"> Password: <input type="password" name="pass">
</form>

<!-- Search Barr -->
<form action="results.php" method="GET">
	<input type="text" name="search">
	<select name="option">
		<option value="movies">		Movies</option>
		<option value="users">		Users</option>
		<option value="actors">		Actors</option>
		<option value="directors">	Directors</option>
		<option value="producers">	Producers</option>
	</select>
	<button type="submit" class="btn btn-primary">Search!</button>
</form>
