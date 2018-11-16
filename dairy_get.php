<?php 

session_start();

$ID = $_GET['id'];

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$stmt = $mysqli->prepare("SELECT * FROM Dairy WHERE ID = ? AND user_id = ?");

$stmt->bind_param("ss", $ID, $_SESSION['ID']);

if( !$stmt->execute() ) {
    echo json_encode(["success" => false]);
    die();
}

$res = $stmt->get_result();

$stmt->close();

while ($row = $res->fetch_assoc()) {
    $arr = [
        "ID" => $row['ID'],
        "date" => $row['date'],
        "title" => $row['title'],
        "description" => $row['description']
    ];
}

echo json_encode($arr);

?>