<!doctype html>
<html>
<head>
<title>MOVIE DATABASE</title>
</head>
<body>
	<?php include('header.php'); ?>

	<h3>Movies</h3>
	<form action="movieresults.php" method="GET" class="form-inline">
		<div class="form-group">
			<label>Title:</label>
			<input type="text" name="title" class="form-control" placeholder="Title"><br>
			<label>Year:</label>
			<input type="number" name="year-min" class="form-control"> to <input type="number" name="year-max" class="form-control"><br>
			<label>Average User Rating: </label>
			<input type="number" name="avg-min" class="form-control"> to <input type="number" name="avg-max" class="form-control"><br>
			Number of User Ratings: <br>
			<input type="number" name="num-rating-min" class="form-control"> to <input type="number" name="num-rating-max" class="form-control"><br>
			MPAA Rating: <br>
			<select name="mpaa-rating" class="form-control">
				<option value="Any"></option>
				<option value="G">G</option>
				<option value="PG">PG</option>
				<option value="PG-13">PG-13</option>
				<option value="R">R</option>
				<option value="NC-17">NC-17</option>
				<option value="Rated">Rated</option>
				<option value="Unrated">Unrated</option>
			</select> <br>
			Actor/Actress: <br>
			<input type="text" name="actor" class="form-control"><br>
			Limit: <br>
			<input type="number" name="amount-movies" class="form-control"> <br>
			<button type="submit" class="btn btn-primary">Search Movies!</button> 
		</div>
	</form>

	<h3>Actors</h3>
	<form action="actorresults.php" method="GET">
		Name: <br>
		<input type="text" name="name"><br>
		Year of Movies Acted In: <br>
		<input type="number" name="year-min"> to <input type="number" name="year-max"><br>
		Number of Movies Acted In: <br>
		<input type="number" name="num-movies-min"> to <input type="number" name="num-movies-max"><br>
		MPAA Rating of Movies Acted In: <br>
		<select name="mpaa-rating">
			<option value="Any"></option>
			<option value="G">G</option>
			<option value="PG">PG</option>
			<option value="PG-13">PG-13</option>
			<option value="R">R</option>
			<option value="NC-17">NC-17</option>
			<option value="Rated">Rated</option>
			<option value="Unrated">Unrated</option>
		</select> <br>
		<button type="submit" class="btn btn-primary">Search Actors!</button>
	</form>
</body>
</html>