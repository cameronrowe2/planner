<?php 

session_start();

require 'db.php';

$ID = $_GET['id'];

$mysqli = m_connect();

$stmt = $mysqli->prepare("SELECT ID, name, email, mobile, phone, reason, website, address, comments FROM Contacts WHERE ID = ? AND user_id = ?");

$stmt->bind_param("ss", $ID, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->bind_result($ID, $name, $email, $mobile, $phone, $reason, $website, $address, $comments);

$arr = [];
while ($stmt->fetch()) {
    $arr = [
        "ID" => $ID,
        "name" => $name,
        "email" => $email,
        "mobile" => $mobile,
        "phone" => $phone,
        "reason" => $reason,
        "website" => $website,
        "address" => $address,
        "comments" => $comments
    ];
}

$stmt->close();

echo json_encode($arr);

?>