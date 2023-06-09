<?php

$host = 'localhost';
$user = "user";
$paswd = "password";
$name = "usr_web_uas";

try {
    $conn = new mysqli($host, $user, $paswd, $name);
} catch (mysqli_sql_exception $e) {
    echo 500;
    die(500);
}
