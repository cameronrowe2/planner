<?php 

session_start();

require 'db.php';

$mysqli = m_connect();

$stmt = $mysqli->prepare("SELECT ID, date, title, description FROM Dairy WHERE user_id = ?");

$stmt->bind_param("s", $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->bind_result($ID, $date, $title, $description);

$arr = [];
while ($stmt->fetch()) {
    $arr[] = [
        "ID" => $ID,
        "date" => htmlspecialchars($date),
        "title" => htmlspecialchars($title),
        "description" => htmlspecialchars($description)
    ];
}

$stmt->close();

echo json_encode($arr);

?>