<?php

session_start();

if(!isset($_SESSION['ID'])){
    header('Location: index.php');
    die();
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <script src="jquery.min.js"></script>
        <script src="bootstrap.bundle.min.js"></script>
        <script src="notes_script.js"></script>
        <link rel="stylesheet" type="text/css" href="notes_styles.css">
        <script src="common_script.js"></script>
        <link rel="stylesheet" type="text/css" href="common_styles.css">
    </head>
    <body>

        <div id="header">
        </div>

        <div class="container">
            <div id="content">
                <input id="search">
                <button id="add">add</button>
                <div id="data" class="table_parent">
                </div>            
            </div>
        </div>
        <div id="note_popup">
            <input class="form-control" type="text" id="title" placeholder="Title">
            <textarea class="form-control" id="description" placeholder="Description" rows="3"></textarea>
            <button class="btn btn-primary" id="submit">Submit</button>
            <button class="btn btn-primary" id="save_edit">Save</button>
        </div>
        <div id="mask"></div>
    </body>
</html>