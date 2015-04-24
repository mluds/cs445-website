<?php session_start(); ?>
<!doctype html>
<html>

<head>
    <title>Generic Movie Database</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="http://code.divshot.com/geo-bootstrap/swatch/bootstrap.min.css" rel="stylesheet-->
    <style>
        .row{
            margin-left:0px;
            margin-right:0px;
        }

        #wrapper {
            padding-left: 70px;
            transition: all .4s ease 0s;
            height: 100%
        }

        #sidebar-wrapper {
            margin-left: -150px;
            left: 70px;
            width: 150px;
            background: #222;
            position: fixed;
            height: 100%;
            z-index: 10000;
            transition: all .4s ease 0s;
        }

        .sidebar-nav {
            display: block;
            float: left;
            width: 150px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        #page-content-wrapper {
            padding-left: 0;
            margin-left: 0;
            width: 100%;
            height: auto;
        }
        #wrapper.active {
            padding-left: 150px;
        }
        #wrapper.active #sidebar-wrapper {
            left: 150px;
        }

        #page-content-wrapper {
          width: 100%;
        }

        #sidebar_menu li a, .sidebar-nav li a {
            color: #999;
            display: block;
            float: left;
            text-decoration: none;
            width: 150px;
            background: #252525;
            border-top: 1px solid #373737;
            border-bottom: 1px solid #1A1A1A;
            -webkit-transition: background .5s;
            -moz-transition: background .5s;
            -o-transition: background .5s;
            -ms-transition: background .5s;
            transition: background .5s;
        }
        .sidebar_name {
            padding-top: 25px;
            color: #fff;
            opacity: .7;
        }

        .sidebar-nav li {
          line-height: 40px;
          text-indent: 20px;
        }

        .sidebar-nav li a {
          color: #999999;
          display: block;
          text-decoration: none;
        }

        .sidebar-nav li a:hover {
          color: #fff;
          background: rgba(255,255,255,0.2);
          text-decoration: none;
        }

        .sidebar-nav li a:active,
        .sidebar-nav li a:focus {
          text-decoration: none;
        }

        .sidebar-nav > .sidebar-brand {
          height: 65px;
          line-height: 60px;
          font-size: 18px;
        }

        .sidebar-nav > .sidebar-brand a {
          color: #999999;
        }

        .sidebar-nav > .sidebar-brand a:hover {
          color: #fff;
          background: none;
        }

        #main_icon
        {
            float:right;
           padding-right: 65px;
           padding-top:20px;
        }
        .sub_icon
        {
            float:right;
           padding-right: 65px;
           padding-top:10px;
        }
        .content-header {
          height: 65px;
          line-height: 65px;
        }

        .content-header h1 {
          margin: 0;
          margin-left: 20px;
          line-height: 65px;
          display: inline-block;
        }

        @media (max-width:767px) {
            #wrapper {
            padding-left: 70px;
            transition: all .4s ease 0s;
        }
        #sidebar-wrapper {
            left: 70px;
        }
        #wrapper.active {
            padding-left: 150px;
        }
        #wrapper.active #sidebar-wrapper {
            left: 150px;
            width: 150px;
            transition: all .4s ease 0s;
        }
        }
    </style>
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
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
            <li><a href="#" data-toggle="modal" data-target="#register">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div class="container">