<?php 

session_start();

require 'db.php';

$mysqli = m_connect();
// echo $mysqli->host_info . "<br>";

$stmt = $mysqli->prepare("SELECT ID, title, description FROM Notes WHERE user_id = ?");

$stmt->bind_param("s", $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->bind_result($ID, $title, $description);

$arr = [];
while ($stmt->fetch()) {
    $arr[] = [
        "ID" => $ID,
        "title" => htmlspecialchars($title),
        "description" => htmlspecialchars($description)
    ];
}

$stmt->close();


echo json_encode($arr);

?>