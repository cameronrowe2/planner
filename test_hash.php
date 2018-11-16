<?php

$text = $_GET['text'];

echo password_hash($text, PASSWORD_DEFAULT);