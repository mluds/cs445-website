<?php

session_start();
unset($_SESSION["uid"]);

$host = $_SERVER["HTTP_HOST"];
header("Location: http://$host/php-wrapper/cs445_FLP_s15/index.php");
exit();

?>