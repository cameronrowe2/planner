<?php 

session_start();

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// echo $mysqli->host_info . "<br>";

$res = $mysqli->query("SELECT * FROM Contacts WHERE user_id = " . $_SESSION['ID']);
$arr = [];
while ($row = $res->fetch_assoc()) {
    $arr[] = [
        "ID" => $row['ID'],
        "name" => $row['name'],
        "email" => $row['email'],
        "mobile" => $row['mobile']
    ];
    // echo " ID = " . $row['ID'] . ", name = " . $row['name'] . ", email = " . $row['email'] . ", phone = " . $row['phone'] . "<br>";
}

echo json_encode($arr);

?>