<?php 

session_start();

require 'db.php';

$ID = $_GET['id'];

$mysqli = m_connect();
// echo $mysqli->host_info . "<br>";

// $res = $mysqli->query("SELECT * FROM Notes WHERE ID = " . $ID . " AND user_id = " . $_SESSION['ID']);

$stmt = $mysqli->prepare("SELECT * FROM Notes WHERE ID = ? AND user_id = ?");

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
        "title" => $row['title'],
        "description" => $row['description']
    ];
}

echo json_encode($arr);

?>