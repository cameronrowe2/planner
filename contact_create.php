<?php

$name = $_GET['name'];
$email = $_GET['email'];
$mobile = $_GET['mobile'];
$phone = $_GET['phone'];
$reason = $_GET['reason'];
$website = $_GET['website'];
$address = $_GET['address'];
$comments = $_GET['comments'];

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$sql = "INSERT INTO Contacts (name, email, mobile, phone, reason, website, address, comments)  VALUES ('". $name . "', '" . $email . "', '" . $mobile . "', '" . $phone . "', '" . $reason . "', '" . $website . "', '" . $address . "', '" . $comments . "')";

if ($mysqli->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}

$mysqli->close();

?>