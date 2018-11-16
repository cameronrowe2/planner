<?php

session_start();

require 'db.php';

$name = $_GET['name'];
$email = $_GET['email'];
$mobile = $_GET['mobile'];
$phone = $_GET['phone'];
$reason = $_GET['reason'];
$website = $_GET['website'];
$address = $_GET['address'];
$comments = $_GET['comments'];

$mysqli = m_connect();

$stmt = $mysqli->prepare("INSERT INTO Contacts (name, email, mobile, phone, reason, website, address, comments, user_id)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssss", $name, $email, $mobile, $phone, $reason, $website, $address, $comments, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->close();

$mysqli->close();

echo json_encode(["success" => true]);

?>