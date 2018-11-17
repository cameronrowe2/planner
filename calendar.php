<?php

session_start();

if(!isset($_SESSION['ID'])){
    header('Location: login.php');
    die();
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <script src="jquery.min.js"></script>
        <script src="bootstrap.bundle.min.js"></script>
        <script src="calendar_script.js"></script>
        <link rel="stylesheet" type="text/css" href="calendar_styles.css">
        <script src="logout_script.js"></script>
        <link rel="stylesheet" type="text/css" href="logout_styles.css">
        <script src="common_script.js"></script>
        <link rel="stylesheet" type="text/css" href="common_styles.css">
    </head>
    <body>

        <div id="header">
            <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Planner</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link active" href="menu.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacts.php">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notes.php">Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="dairy.php">Dairy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="calendar.php">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="logout.php">Logout</a>
                    </li>
                    </ul>
                </div>
            </nav> -->
        </div>

        <div class="container">
            <div id="content">
                <div id="data">
                </div>            
            </div>
        </div>
        <div id="calendar_popup">
            <input id="title" placeholder="Title">
            <textarea id="description" placeholder="Description"></textarea>
            <input type="time" id="time" placeholder="Time">
            <button id="submit">Submit</button>
            <button id="save_edit">Save</button>
            <button id="delete">Delete</button>
        </div>
        <div id="mask"></div>
    </body>
</html>