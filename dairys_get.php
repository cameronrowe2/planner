<?php 

session_start();

require 'db.php';

$mysqli = m_connect();

$stmt = $mysqli->prepare("SELECT * FROM Dairy WHERE user_id = ?");

$stmt->bind_param("s", $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$res = $stmt->get_result();

$stmt->close();


$arr = [];
while ($row = $res->fetch_assoc()) {
    $arr[] = [
        "ID" => $row['ID'],
        "date" => htmlspecialchars($row['date']),
        "title" => htmlspecialchars($row['title']),
        "description" => htmlspecialchars($row['description'])
    ];
}

echo json_encode($arr);

?>