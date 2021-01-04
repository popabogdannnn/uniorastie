<?php
session_start();


if(isset($_POST['submit']) && $_SESSION['privilege'] === 0) {
    require 'database.php';
    $sql = "INSERT INTO preda_la_grupa (profesor_username, grupaID, nume_materie) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../register.php?error=sqlerror");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $_POST['usernameProf'], $_POST['grupaID'], $_POST['materie']);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?succes=createcomplete");
}
else {
    header("Location: ../index.php");
    exit();
}

?>