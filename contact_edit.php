<?php 

$ID = $_GET['id'];
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
// echo $mysqli->host_info . "<br>";

$sql = "UPDATE Contacts SET name='" . $name . "', email='" . $email . "', mobile='" . $mobile . "', phone='" . $phone . "', reason='" . $reason . "', website='" . $website . "', address='" . $address . "', comments='" . $comments . "' WHERE ID = " . $ID;


if ($mysqli->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

?>