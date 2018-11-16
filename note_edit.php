<?php 

session_start();

require 'db.php';

$ID = $_GET['id'];
$title = $_GET['title'];
$description = $_GET['description'];

$mysqli = m_connect();
// echo $mysqli->host_info . "<br>";

$stmt = $mysqli->prepare("UPDATE Notes SET title=?, description=? WHERE ID = ? AND user_id = ?");

$stmt->bind_param("ssss", $title, $description, $ID, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
} else {
    echo json_encode(["success" => true]);
}

$stmt->close();

?>