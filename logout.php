<?php

session_start();

unset($_SESSION['ID']);

header('Location: login.php');
?>