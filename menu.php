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
        <script src="logout_script.js"></script>
        <link rel="stylesheet" type="text/css" href="logout_styles.css">
    </head>
    <body>
        <div>
            <table>
                <tr>
                    <th><a href="contacts.php">Contacts</a></th>
                    <th><a href="notes.php">Notes</a></th>
                    <th><a href="dairy.php">Dairy</a></th>
                    <th><a href="calendar.php">Calendar</a></th>
                </tr>
            </table>            
        </div>
    </body>
</html>