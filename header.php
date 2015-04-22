0;136;0c<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<nav class="navbar navbar-default">
  <div class="navbar-header">
    <a class="navbar-brand" href="index.php">Generic Movie Database</a>
  </div>

  <ul class="nav navbar-nav">
    <li><a href="search.php">Advanced Search</a></li>
  </ul>

  <form action="results.php" method="get" class="navbar-form navbar-left" role="search">
    <div class="form-group">
      <input name="search" type="text" class="form-control" placeholder="Search">
      <select name="option" class="form-control">
        <option value="movies">Movies</option>
        <option value="users">Users</option>
        <option value="actors">Actors</option>
        <option value="directors">Directors</option>
        <option value="producers">Producers</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>

  <?php if (isset($_SESSION["uid"])): ?>

  <form action="logout.php">
    <button type="submit" class="btn btn-default">Logout</button>
  </form>

  <?php else: ?>

  <form action="login.php" method="post" class="navbar-form navbar-left">
    <div class="form-group">
      <input name="email" type="text" class="form-control" placeholder="Email">
      <input name="password" type="text" class="form-control" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">Login</button>
  </form>

  <?php endif; ?>

</nav>
