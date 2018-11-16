<?php 

session_start();

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// echo $mysqli->host_info . "<br>";

$stmt = $mysqli->prepare("SELECT * FROM Notes WHERE user_id = ?");

$stmt->bind_param("s", $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$res = $stmt->get_result();

$stmt->close();

$arr = [];
while ($row = $res->fetch_assoc()) {
    $arr[] = [
        "ID" => $row['ID'],
        "title" => $row['title'],
        "description" => $row['description']
    ];
    // echo " ID = " . $row['ID'] . ", name = " . $row['name'] . ", email = " . $row['email'] . ", phone = " . $row['phone'] . "<br>";
}

echo json_encode($arr);

?>