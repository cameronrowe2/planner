<?php

session_start();

$date = $_GET['date'];
$title = $_GET['title'];
$description = $_GET['description'];
$time = $_GET['time'];

$time .= ":00";

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$stmt = $mysqli->prepare("INSERT INTO Calendar (date, title, description, time, user_id)  VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("sssss", $date, $title, $description, $time, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->close();

$mysqli->close();

echo json_encode(["success" => true]);

?>