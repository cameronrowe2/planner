<?php

session_start();

require 'db.php';

$email = $_GET['email'];
$password = $_GET['password'];

$mysqli = m_connect();

$sql = "SELECT * FROM Login where email like '" . $email . "'";

$res = $mysqli->query($sql);
if($row = $res->fetch_assoc()){
    // check password
    if(password_verify($password, $row['password'])) {
        $_SESSION["ID"] = $row['ID'];
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
} else {
    echo json_encode(["success" => false]);
}








?>