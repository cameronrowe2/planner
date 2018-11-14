<?php

$date = $_GET['date'];
$title = $_GET['title'];
$description = $_GET['description'];
$time = $_GET['time'];

$time .= ":00";

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$sql = "INSERT INTO Calendar (date, title, description, time)  VALUES ('". $date . "', '" . $title . "', '" . $description . "', '" . $time . "')";

if ($mysqli->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}

$mysqli->close();

?>