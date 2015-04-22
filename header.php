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
    </form>

    <?php if (isset($_SESSION['id'])): ?>
    <?php else: ?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <ul class="nav navbar-nav">
        <li><a href="search.php">Advanced Search</a></li>
        <?php if (isset($_SESSION['email']) and $_SESSION['email'] == 'admin'): ?>
            <li><a href="admin.php">SQL Interface</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['id'])): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a data-toggle="modal" data-target="#myModal">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>
