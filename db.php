<?php

// Dev
define("HOST", "127.0.0.1");
define("USERNAME", "root");
define("PASSWORD", "root");
define("DBNAME", "planner");

// echo CONSTANT; // outputs "Hello world."

function m_connect() {
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}
