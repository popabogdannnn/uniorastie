<?php
session_start();


if(isset($_POST['submit']) && $_SESSION['privilege'] === 0) {
    require 'database.php';
    $sql = "DELETE FROM utilizatori WHERE userID = ?";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }

    $id = intval($_POST['id']);

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?succes=deletecomplete");
}
else {
    header("Location: ../index.php");
    exit();
}

?>