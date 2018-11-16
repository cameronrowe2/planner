<?php 

session_start();

$ID = $_GET['id'];
$date = $_GET['date'];
$title = $_GET['title'];
$description = $_GET['description'];

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// echo $mysqli->host_info . "<br>";

$sql = "UPDATE Dairy SET date='" . $date . "', title='" . $title . "', description='" . $description . "' WHERE ID = " . $ID . " AND user_id = " . $_SESSION['ID'];


if ($mysqli->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

?>