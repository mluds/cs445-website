<?php include('header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Movies</h3>
            <form action="movieresults.php" method="GET" class="form-inline">
                <div class="form-group">
                    <label>Title:</label><br>
                    <input type="text" name="title" class="form-control"><br>
                    <label>Year:</label><br>
                    <input type="number" name="year-min" class="form-control"> to <input type="number" name="year-max" class="form-control"><br>
                    <label>Average User Rating: </label><br>
                    <input type="number" name="avg-min" class="form-control"> to <input type="number" name="avg-max" class="form-control"><br>
                    <label>Number of User Ratings: </label><br>
                    <input type="number" name="num-rating-min" class="form-control"> to <input type="number" name="num-rating-max" class="form-control"><br>
                    <label>MPAA Rating: </label><br>
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
                    <label>Actor/Actress: </label><br>
                    <input type="text" name="actor" class="form-control"><br>
                    <label>Limit: </label><br>
                    <input type="number" name="amount-movies" class="form-control"> <br><br>
                    <button type="submit" class="btn btn-primary">Search Movies!</button> 
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <h3>Actors</h3>
            <form action="actorresults.php" method="GET" class="form-inline">
                <div class="form-group">
                    <label>Name: </label><br>
                    <input type="text" name="name" class="form-control"><br>
                    <label>Year of Movies Acted In: </label><br>
                    <input type="number" name="year-min" class="form-control"> to <input type="number" name="year-max" class="form-control"><br>
                    <label>Number of Movies Acted In: </label><br>
                    <input type="number" name="num-movies-min" class="form-control"> to <input type="number" name="num-movies-max" class="form-control"><br>
                    <label>MPAA Rating of Movies Acted In: </label><br>
                    <select name="mpaa-rating" class="form-control">
                        <option value="Any"></option>
                        <option value="G">G</option>
                        <option value="PG">PG</option>
                        <option value="PG-13">PG-13</option>
                        <option value="R">R</option>
                        <option value="NC-17">NC-17</option>
                        <option value="Rated">Rated</option>
                        <option value="Unrated">Unrated</option>
                    </select> <br><br>
                    <button type="submit" class="btn btn-primary">Search Actors!</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>