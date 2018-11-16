<?php 

session_start();

require 'db.php';

$ID = $_GET['id'];

$mysqli = m_connect();

$stmt = $mysqli->prepare("SELECT ID, date, title, description FROM Dairy WHERE ID = ? AND user_id = ?");

$stmt->bind_param("ss", $ID, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->bind_result($ID, $date, $title, $description);

while ($stmt->fetch()) {
    $arr = [
        "ID" => $ID,
        "date" => $date,
        "title" => $title,
        "description" => $description
    ];
}

$stmt->close();

echo json_encode($arr);

?>