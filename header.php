<?php session_start(); ?>
<!doctype html>
<html>

<head>
    <title>Generic Movie Database</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-default">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Generic Movie Database</a>
    </div>

    <ul class="nav navbar-nav">
        <li><a href="search.php">Advanced Search</a></li>
        <?php if ($_SESSION['email'] == 'admin'): ?>
            <li><a href="admin.php">SQL Interface</a></li>
        <?php endif; ?>
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

    <?php if (isset($_SESSION['id'])): ?>

    <form action="logout.php" class="navbar-form navbar-left">
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

    <form action="register.php" class="navbar-form navbar-left">
        <button type="submit" class="btn btn-default">Register</button>
    </form>

    <?php endif; ?>
</nav>
