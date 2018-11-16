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
        <script src="notes_script.js"></script>
        <link rel="stylesheet" type="text/css" href="notes_styles.css">
        <script src="logout_script.js"></script>
        <link rel="stylesheet" type="text/css" href="logout_styles.css">
    </head>
    <body>
        <div>
            <input id="search">
            <button id="add">add</button>
            <table id="data">
            </table>            
        </div>
        <div id="note_popup">
            <input id="title" placeholder="Title">
            <textarea id="description" placeholder="Description"></textarea>
            <button id="submit">Submit</button>
            <button id="save_edit">Save</button>
        </div>
        <div id="mask"></div>
    </body>
</html>