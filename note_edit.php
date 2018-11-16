<?php 

session_start();

$ID = $_GET['id'];
$title = $_GET['title'];
$description = $_GET['description'];

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
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