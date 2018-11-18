<?php

// Dev
// define("HOST", "127.0.0.1");
// define("USERNAME", "root");
// define("PASSWORD", "root");
// define("DBNAME", "planner");

// Live
define("HOST", "localhost");
define("USERNAME", "planner6_root");
define("PASSWORD", "JU1CYl3m0n");
define("DBNAME", "planner6_planner");

// echo CONSTANT; // outputs "Hello world."

function m_connect() {
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}
