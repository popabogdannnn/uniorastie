<?php

if(isset($_POST['submit'])) {
    require 'database.php';
    if(!userExists($_POST['user'])) {
        header("Location: ../message.php?error=userinexistent");
        exit();
    }
    $sql = "INSERT INTO trimite_primeste_mesaj (user_trimite, user_primeste, mesaj) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    $sessionUser = $_GET['sessionuser'];

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $sessionUser, $_POST['user'], $_POST['message']);
    mysqli_stmt_execute($stmt);
    header("Location: ../message.php?succes=messagesent");
    exit();
}
else {
    header("Location: ../index.php");
    exit();
}

?>