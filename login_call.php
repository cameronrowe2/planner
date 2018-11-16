<?php

session_start();

require 'db.php';

$email = $_GET['email'];
$password = $_GET['password'];

$mysqli = m_connect();

$stmt = $mysqli->prepare("SELECT ID, password FROM Login where email like ?");

$stmt->bind_param("s", $email);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$stmt->bind_result($ID, $hash_password);

if($stmt->fetch()){
    // check password
    if(password_verify($password, $hash_password)) {
        $_SESSION["ID"] = $ID;
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
} else {
    echo json_encode(["success" => false]);
}

$stmt->close();

?>