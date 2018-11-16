<?php 

session_start();

$ID = $_GET['id'];

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

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