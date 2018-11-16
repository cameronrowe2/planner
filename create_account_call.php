<?php

session_start();

require 'db.php';

$email = $_GET['email'];
$password = $_GET['password'];
$password2 = $_GET['password2'];

$mysqli = m_connect();

// check if email exists
$sql = "SELECT * FROM Login where email like '" . $email . "'";
$res = $mysqli->query($sql);
if($res->num_rows > 0) {
    echo json_encode(["success" => false]);
    exit();
}

// check if passwords are the same
if($password != $password2) {
    echo json_encode(["success" => false]);
    exit();
}

// hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

// insert into table
$sql = "INSERT INTO Login (email, password)  VALUES ('". $email . "', '" . $hash . "')";

if ($mysqli->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}

?>