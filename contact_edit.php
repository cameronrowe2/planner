<?php 

session_start();

require 'db.php';

$ID = $_GET['id'];
$name = $_GET['name'];
$email = $_GET['email'];
$mobile = $_GET['mobile'];
$phone = $_GET['phone'];
$reason = $_GET['reason'];
$website = $_GET['website'];
$address = $_GET['address'];
$comments = $_GET['comments'];

$mysqli = m_connect();

$stmt = $mysqli->prepare("UPDATE Contacts SET name=?, email=?, mobile=?, phone=?, reason=?, website=?, address=?, comments=? WHERE ID = ? AND user_id = ?");

$stmt->bind_param("ssssssssss", $name, $email, $mobile, $phone, $reason, $website, $address, $comments, $ID, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->close();

echo json_encode(["success" => true]);

?>