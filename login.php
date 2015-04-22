<?php

$conn = new mysqli("cs445sql", "mdludwig", "EL104mdl", "FLP");
if ($conn->connect_error) {
    die();
}

$user_t = $conn->query("select u.id, u.password from users u where u.email='" . $_POST["email"] . "'");
$conn->close();

if ($user_t->num_rows == 1) {
    $user = $user_t->fetch_assoc();
    if ($user["password"] == $_POST["password"]) {
        session_start();
        $_SESSION["uid"] = $user["id"];
    }
}

$host = $_SERVER["HTTP_HOST"];
header("Location: http://$host/php-wrapper/cs445_FLP_s15/index.php");
exit();
?>
