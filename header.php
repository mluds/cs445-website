<?php session_start(); ?>
<!doctype html>
<html>

<head>
    <title>Generic Movie Database</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="http://code.divshot.com/geo-bootstrap/swatch/bootstrap.min.css" rel="stylesheet-->
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

    <?php if (!isset($_SESSION['id'])): ?>
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="login.php" method="post">
                            <div class="form-group"><input name="email" type="text" class="form-control" placeholder="Email"></div>
                            <div class="form-group"><input name="password" type="password" class="form-control" placeholder="Password"></div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Register</h4>
                    </div>
                    <div class="modal-body">
                        <form action="register.php" method="post">
                            <div class="form-group"><input name="email" type="email" class="form-control" placeholder="Email" required></div>
                            <div class="form-group"><input name="password" type="password" class="form-control" placeholder="Password" required></div>
                            <div class="form-group"><input name="pass-confirm" type="password" class="form-control" placeholder="Confirm Password" required></div>
                            <div class="form-group"><input name="name" type="text" class="form-control" placeholder="Full Name"></div>
                            <div class="form-group"><input name="age" type="number" class="form-control" placeholder="Age"></div>
                            <div class="form-group"><input name="location" type="text" class="form-control" placeholder="Location"></div>
			    <div class="form-group">
                                <label class="radio-inline"><input type="radio" name="gender" value="M">Male</label>
                                <label class="radio-inline"><input type="radio" name="gender" value="F">Female</label>
			    </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
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
	    <li><a href="user.php?id=<?php echo $_SESSION['id']; ?>">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
            <li><a href="#" data-toggle="modal" data-target="#register">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div class="container">