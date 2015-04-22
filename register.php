<?php

$can_register = !empty($_POST['email']) &&
    !empty($_POST['password']) &&
    !empty($_POST['pass-confirm']) &&
    $_POST['password'] === $_POST['pass-confirm'];

if ($can_register) {

    $conn = new mysqli("cs445sql", "mdludwig", "EL104mdl", "FLP");
    if ($conn->connect_error) {
        die();
    }

    $fields = array("email", "name", "password", "age", "gender", "location");
    $fields_str = '';
    $value_str = '';
    foreach ($fields as $field) {
        if (isset($_POST[$field]) and $_POST[$field] != '') {
	    if ($fields_str != '') {
	        $fields_str .= ',';
	    }
	    if ($value_str != '') {
	        $value_str .= ',';
	    }
	    $fields_str .= $field;
	    $value_str .= "'" . $conn->escape_string($_POST[$field]) . "'";
	}
    }

    $query = "insert into users ($fields_str) value($value_str)";

    $conn->query($query);
    $conn->close();
}

header("Location: http://cs445.cs.umass.edu/php-wrapper/cs445_FLP_s15/index.php");
exit();

?>