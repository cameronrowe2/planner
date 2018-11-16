<?php 

session_start();

require 'db.php';

$ID = $_GET['id'];

$mysqli = m_connect();

$stmt = $mysqli->prepare("DELETE FROM Notes WHERE ID = ? AND user_id = ?");
$stmt->bind_param("ss", $ID, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
} else {
    echo json_encode(["success" => true]);
}

$stmt->close();

// while ($row = $res->fetch_assoc()) {
//     $arr = [
//         "ID" => $row['ID'],
//         "name" => $row['name'],
//         "email" => $row['email'],
//         "phone" => $row['phone']
//     ];
//     // echo " ID = " . $row['ID'] . ", name = " . $row['name'] . ", email = " . $row['email'] . ", phone = " . $row['phone'] . "<br>";
// }

// echo json_encode(["success" => $res]);

?>