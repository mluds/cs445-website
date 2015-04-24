<?php

session_start();
unset($_SESSION['id']);
unset($_SESSION['email']);

$host = $_SERVER['HTTP_HOST' ];
header("Location: http://$host/php-wrapper/cs445_FLP_s15/index.php");
exit();

?>