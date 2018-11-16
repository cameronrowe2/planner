<?php

session_start();

require 'db.php';

$title = $_GET['title'];
$description = $_GET['description'];

$mysqli = m_connect();

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