<?php

session_start();

if(isset($_SESSION['ID'])){
    header('Location: menu.php');
    die();
}
?>

<html>
    <head>
        <script src="jquery.min.js"></script>
        <script src="create_account_script.js"></script>
        <!-- <link rel="stylesheet" type="text/css" href="login_styles.css"> -->
    </head>
    <body>
        <input id="email">
        <input id="password" type="password">
        <input id="password2" type="password">
        <button id="submit">Submit</button>
    </body>
</html>