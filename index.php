<?php

session_start();

if(isset($_SESSION['ID'])){
    header('Location: calendar.php');
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
        <script src="index_script.js"></script>
        <link rel="stylesheet" type="text/css" href="index_styles.css">
        <script src="common_script.js"></script>
        <link rel="stylesheet" type="text/css" href="common_styles.css">
    </head>
    <body id="home">
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 id="heading" class="display-1">Planner</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn" id="login">Login</button>
                    <button class="btn" id="create_account">Create Account</button>
                </div>
                <div class="col-md-6">
                    <div id="list_parent">
                        <ul id="list">
                            <li>Update Calendar</li>
                            <li>Update Dairy</li>
                            <li>Add Notes</li>
                            <li>Add Contacts</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="login_popup">
            <input class="form-control" type="email" id="login_email" placeholder="Email">
            <input class="form-control" type="password" id="login_password" placeholder="Password">          
            <button class="btn btn-primary" id="submit_login">Login</button>
        </div>
        <div id="create_account_popup">
            <input class="form-control" type="email" id="create_account_email" placeholder="Email">
            <input class="form-control" type="password" id="create_account_password" placeholder="Password"> 
            <input class="form-control" type="password" id="create_account_password2" placeholder="Password2">         
            <button class="btn btn-primary" id="submit_create_account">Create Account</button>
        </div>
        <div id="mask"></div>
    </body>
</html>