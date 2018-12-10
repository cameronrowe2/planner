<?php

session_start();

require 'db.php';

$email = $_GET['email'];
$password = $_GET['password'];
$password2 = $_GET['password2'];

$mysqli = m_connect();


$date = date('Y-m-d');
$addr = $_SERVER['REMOTE_ADDR'];

$stmt = $mysqli->prepare("SELECT ID FROM CreateAccountAttempts where date = ? and addr = ?");
$stmt->bind_param("ss", $date, $addr);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->bind_result($ID_res);

$count = 0;
while($stmt->fetch()){
    $count++;
}

if($count > 2) {
    echo json_encode(["success" => false]);
    exit();
}



$stmt = $mysqli->prepare("SELECT ID FROM Login where email like ?");

$stmt->bind_param("s", $email);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->bind_result($ID);

$count = 0;
if($stmt->fetch()){
    $count++;
}

if($count > 0) {
    echo json_encode(["success" => false]);
    exit();
}

// check if passwords are the same
if($password != $password2) {
    echo json_encode(["success" => false]);
    exit();
}

// store CreateAccountAttempt in database
$stmt2 = $mysqli->prepare("INSERT INTO CreateAccountAttempts (date, addr) VALUES (?, ?)");

if (!($stmt2)) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
$stmt2->bind_param("ss", $date, $addr);

if( !$stmt2->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

// hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("INSERT INTO Login (email, password)  VALUES (?, ?)");

$stmt->bind_param("ss", $email, $hash);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

echo json_encode(["success" => true]);

?>