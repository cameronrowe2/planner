<?php 

session_start();

require 'db.php';

$ID = $_GET['id'];
$date = $_GET['date'];
$title = $_GET['title'];
$description = $_GET['description'];
$time = $_GET['time'];

$time .= ":00";

$mysqli = m_connect();

$stmt = $mysqli->prepare("UPDATE Calendar SET date=?, title=?, description=?, time=? WHERE ID = ? AND user_id = ?");

$stmt->bind_param("ssssss", $date, $title, $description, $time, $ID, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->close();

echo json_encode(["success" => true]);
?>