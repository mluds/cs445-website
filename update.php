<?php

session_start();

$conn = new mysqli("cs445sql", "mdludwig", "EL104mdl", "FLP");
if ($conn->connect_error) {
    die();
}

$latest = $_POST['latest'];

if ($latest == "") {
    $time = 0;
} else {
    $time = $latest;
}

$query="SELECT u.id,u.name,r.rating,r.time,m.title,m.year FROM ratings r,friends f,users u,movies m WHERE f.uid1=" . $_SESSION['id'] . " and r.uid=f.uid2 and r.mid=m.id and u.id=r.uid order by r.time desc limit 5";

$res = $conn->query($query);
if ($res->num_rows > 0) {
    $updates = array();
    while ($row = $res->fetch_assoc()) {
        $updates[] = $row;
    }
    $latest = $updates[0]['time'];
    $json = array(
        "latest" => $latest,
	"updates" => $updates
    );
    echo json_encode($json);
}

?>