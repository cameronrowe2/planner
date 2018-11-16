<?php

session_start();

require 'db.php';

$date = $_GET['date'];
$title = $_GET['title'];
$description = $_GET['description'];
$time = $_GET['time'];

$time .= ":00";

$mysqli = m_connect();

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