<?php

session_start();

$title = $_GET['title'];
$description = $_GET['description'];

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$stmt = $mysqli->prepare("INSERT INTO Notes (title, description, user_id)  VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $description, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
} else {
    echo json_encode(["success" => true]);
}

$stmt->close();


// $sql = "INSERT INTO Notes (title, description, user_id)  VALUES ('". $title . "', '" . $description . "', '" . $_SESSION['ID'] . "')";

// if ($mysqli->query($sql) === TRUE) {
//     echo json_encode(["success" => true]);
// } else {
//     echo json_encode(["success" => false]);
// }

$mysqli->close();

?>