<?php

if(isset($_POST['submit'])) {
    require 'database.php';
    $sql = "UPDATE Utilizatori set privilege = ? WHERE userID = ?";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?error=sqlerror");
        exit();
    }
    
    $privilege = intval($_POST['privilege']);
    $id = intval($_POST['id']);

    mysqli_stmt_bind_param($stmt, "ii", $privilege, $id);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?succes=updatecomplete");
}
else {
    header("Location: ../index.php");
    exit();
}

?>