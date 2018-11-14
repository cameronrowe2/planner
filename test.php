<?php 

$mysqli = new mysqli("127.0.0.1", "root", "root", "planner");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "<br>";

$date = "21-06-2018";
echo $date . "<br>";
$date=date("Y-m-d",strtotime($date));
echo $date . "<br>";



$res = $mysqli->query("SELECT ID FROM Contacts");
$str = "";
while ($row = $res->fetch_assoc()) {
    $str .= " ID = " . $row['ID'] . "<br>";
}

if($str === "") {
    echo "Empty";
}
else {
    echo $str;
}

?>