<?php 

session_start();

require 'db.php';

$ID = $_GET['id'];

$mysqli = m_connect();

$stmt = $mysqli->prepare("SELECT * FROM Contacts WHERE ID = ? AND user_id = ?");

$stmt->bind_param("ss", $ID, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$res = $stmt->get_result();

$stmt->close();


while ($row = $res->fetch_assoc()) {
    $arr = [
        "ID" => $row['ID'],
        "name" => $row['name'],
        "email" => $row['email'],
        "mobile" => $row['mobile'],
        "phone" => $row['phone'],
        "reason" => $row['reason'],
        "website" => $row['website'],
        "address" => $row['address'],
        "comments" => $row['comments']
    ];
}

echo json_encode($arr);

?>