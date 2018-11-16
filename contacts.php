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
        <script src="contacts_script.js"></script>
        <link rel="stylesheet" type="text/css" href="contacts_styles.css">
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
        <div id="contact_popup">
            <input id="name" placeholder="Name">
            <input id="email" placeholder="Email">
            <input id="mobile" placeholder="Mobile">
            <input id="phone" placeholder="Home Phone">
            <textarea id="reason" rows="2" placeholder="Reason for adding to contacts"></textarea>
            <input id="website" placeholder="Website">
            <input id="address" placeholder="Address">
            <textarea id="comments" rows="4" placeholder="Comments"></textarea>
            <button id="submit">Submit</button>
            <button id="save_edit">Save</button>
        </div>
        <div id="mask"></div>
    </body>
</html>