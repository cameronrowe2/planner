<?php

session_start();

$email = $_GET['email'];
$password = $_GET['password'];

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

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