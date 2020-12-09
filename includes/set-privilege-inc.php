<?php
session_start();

if(isset($_POST['submit']) && $_SESSION['privilege'] === 0) {
    require 'database.php';
    
    $privilege = intval($_POST['privilege']);
    $id = intval($_POST['id']);
    
    $ans = getFromTableBy($conn, "utilizatori", "userID", $id);

    if($ans[0]['privilege'] !== 2) {
        header("Location: ../index.php?error=nuebn");
        exit();
    }

    $sql = "UPDATE utilizatori SET privilege = ? WHERE userID = ?";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $privilege, $id);
    mysqli_stmt_execute($stmt);

    if($privilege == 3) {
        $sql = "INSERT INTO studenti (username, grupaID) VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        $grupaID = "Grupa 234";
        mysqli_stmt_bind_param($stmt, "ss", $ans[0]['username'], $grupaID);
        mysqli_stmt_execute($stmt);
        header("Location: ../index.php?succes=updatecomplete2");
        exit();
    }

    if($privilege == 1) {
        $sql = "INSERT INTO preda_la_grupa (profesor_username, grupaID, nume_materie) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        $grupaID = "Grupa 234";
        $materie = "DAW";
        mysqli_stmt_bind_param($stmt, "sss", $ans[0]['username'], $grupaID, $materie);
        mysqli_stmt_execute($stmt);
        header("Location: ../index.php?succes=updatecomplete3");
        exit();
    }

    header("Location: ../index.php?succes=updatecomplete");
    exit();
}
else {
    header("Location: ../index.php");
    exit();
}

?>