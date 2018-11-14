<?php 

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// echo $mysqli->host_info . "<br>";

$res = $mysqli->query("SELECT * FROM Dairy");
$arr = [];
while ($row = $res->fetch_assoc()) {
    $arr[] = [
        "ID" => $row['ID'],
        "date" => $row['date'],
        "title" => $row['title'],
        "description" => $row['description']
    ];
    // echo " ID = " . $row['ID'] . ", name = " . $row['name'] . ", email = " . $row['email'] . ", phone = " . $row['phone'] . "<br>";
}

echo json_encode($arr);

?>