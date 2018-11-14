<?php 

$ID = $_GET['id'];

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// echo $mysqli->host_info . "<br>";

$res = $mysqli->query("SELECT * FROM Contacts WHERE ID = " . $ID);
while ($row = $res->fetch_assoc()) {
    $arr = [
        "ID" => $row['ID'],
        "name" => $row['name'],
        "email" => $row['email'],
        "mobile" => $row['mobile'],
        "phone" => $row['phone'],
        "reason" => $row['reason'],
        "website" => $row['website'],
        "address" => $row['address'],
        "comments" => $row['comments']
    ];
    // echo " ID = " . $row['ID'] . ", name = " . $row['name'] . ", email = " . $row['email'] . ", phone = " . $row['phone'] . "<br>";
}

echo json_encode($arr);

?>