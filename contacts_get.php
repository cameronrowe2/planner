<?php 

session_start();

require 'db.php';

$mysqli = m_connect();

$stmt = $mysqli->prepare("SELECT ID, name, email, mobile FROM Contacts WHERE user_id = ?");

$stmt->bind_param("s", $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->bind_result($ID, $name, $email, $mobile);


$arr = [];
while ($stmt->fetch()) {
    $arr[] = [
        "ID" => $ID,
        "name" => htmlspecialchars($name),
        "email" => htmlspecialchars($email),
        "mobile" => htmlspecialchars($mobile)
    ];
}

$stmt->close();

echo json_encode($arr);

?>