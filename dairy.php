<?php

session_start();

if(!isset($_SESSION['ID'])){
    header('Location: login.php');
    die();
}
?>

<html>
    <head>
        <script src="jquery.min.js"></script>
        <script src="dairy_script.js"></script>
        <link rel="stylesheet" type="text/css" href="dairy_styles.css">
        <script src="logout_script.js"></script>
        <link rel="stylesheet" type="text/css" href="logout_styles.css">
    </head>
    <body>
        <div>
            <div id="data">
            </div>            
        </div>
        <div id="dairy_popup">
            <input id="title" placeholder="Title">
            <textarea id="description" placeholder="Description"></textarea>
            <button id="submit">Submit</button>
            <button id="save_edit">Save</button>
            <button id="delete">Delete</button>
        </div>
        <div id="mask"></div>
    </body>
</html>