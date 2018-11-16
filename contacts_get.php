<?php 

session_start();

require 'db.php';

$mysqli = m_connect();

$stmt = $mysqli->prepare("SELECT * FROM Contacts WHERE user_id = ?");

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
        "name" => htmlspecialchars($row['name']),
        "email" => htmlspecialchars($row['email']),
        "mobile" => htmlspecialchars($row['mobile'])
    ];
}

echo json_encode($arr);

?>