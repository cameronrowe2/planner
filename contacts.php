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
        <script src="common_script.js"></script>
        <script src="contacts_script.js"></script>
        <link rel="stylesheet" type="text/css" href="contacts_styles.css">
        <link rel="stylesheet" type="text/css" href="common_styles.css">
    </head>
    <body>

        <div id="header">
        </div>

        <div class="container">
            <div id="content">
                <div class="row" id="top_content">
                    <div class="col-md-6">
                        <input class="form-control" type="text" id="search" placeholder="Search...">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary" id="add">Add</button>
                    </div>
                </div>
                <div id="data" class="table_parent">
                </div>            
            </div>
        </div>
        <div id="contact_popup">
            <input class="form-control" type="text" id="name" placeholder="Name">
            <input class="form-control" type="text" id="email" placeholder="Email">
            <input class="form-control" type="text" id="mobile" placeholder="Mobile">
            <input class="form-control" type="text" id="phone" placeholder="Home Phone">
            <textarea class="form-control" id="reason" placeholder="Reason for adding to contacts" rows="3"></textarea>
            <input class="form-control" type="text" id="website" placeholder="Website">
            <input class="form-control" type="text" id="address" placeholder="Address">
            <textarea class="form-control" id="comments" placeholder="Comments" rows="3"></textarea>
            <button class="btn btn-primary" id="submit">Submit</button>
        </div>
        <div id="contact_edit_popup">
            <input class="form-control" type="text" id="name_edit" placeholder="Name">
            <input class="form-control" type="text" id="email_edit" placeholder="Email">
            <input class="form-control" type="text" id="mobile_edit" placeholder="Mobile">
            <input class="form-control" type="text" id="phone_edit" placeholder="Home Phone">
            <textarea class="form-control" id="reason_edit" placeholder="Reason for adding to contacts" rows="3"></textarea>
            <input class="form-control" type="text" id="website_edit" placeholder="Website">
            <input class="form-control" type="text" id="address_edit" placeholder="Address">
            <textarea class="form-control" id="comments_edit" placeholder="Comments" rows="3"></textarea>
            <button class="btn btn-primary" id="save_edit">Save</button>
        </div>
        <div id="mask"></div>
    </body>
</html>