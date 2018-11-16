<?php

session_start();

require 'db.php';

$date = $_GET['date'];
$title = $_GET['title'];
$description = $_GET['description'];

$mysqli = m_connect();

$stmt = $mysqli->prepare("INSERT INTO Dairy (date, title, description, user_id)  VALUES (?, ?, ?, ?)");

$stmt->bind_param("ssss", $date, $title, $description, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->close();

$mysqli->close();

echo json_encode(["success" => true]);

?>