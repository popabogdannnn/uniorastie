<?php

$domain = "localhost/project";
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "facultate";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if(!$conn) {
    die("Database connection failed!");
}

function userExists($username, $conn) {
    $sql = "SELECT * FROM utilizatori WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)) {
        return True;
    }
    else {
        return False;
    }

}

function getFromTableBy($conn, $table, $col, $val) {
    $sql = "SELECT * FROM $table WHERE $col = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $val);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $ret = [];
    while($row = mysqli_fetch_assoc($result)) {
        array_push($ret, $row);
    }

    return $ret;
}


?>