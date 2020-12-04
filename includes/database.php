<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "facultate";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if(!$conn) {
    die("Database connection failed!");
}


function userExists($username) {
    return True;
}

?>