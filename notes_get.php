<?php 

session_start();

require 'db.php';

$mysqli = m_connect();
// echo $mysqli->host_info . "<br>";

$stmt = $mysqli->prepare("SELECT * FROM Notes WHERE user_id = ?");

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
        "title" => htmlspecialchars($row['title']),
        "description" => htmlspecialchars($row['description'])
    ];
    // echo " ID = " . $row['ID'] . ", name = " . $row['name'] . ", email = " . $row['email'] . ", phone = " . $row['phone'] . "<br>";
}

echo json_encode($arr);

?>