<?php 

session_start();

require 'db.php';

$ID = $_GET['id'];
$date = $_GET['date'];
$title = $_GET['title'];
$description = $_GET['description'];

$mysqli = m_connect();

$stmt = $mysqli->prepare("UPDATE Dairy SET date=?, title=?, description=? WHERE ID = ? AND user_id = ?");

$stmt->bind_param("sssss", $date, $title, $description, $ID, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->close();

echo json_encode(["success" => true]);

?>