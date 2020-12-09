<?php
session_start();

if(isset($_POST['submit']) && isset($_SESSION['sessionId'])) {
    require 'database.php';

    if(!userExists($_POST['user'], $conn)) {
        header("Location: ../message.php?error=userinexistent");
        exit();
    }
   
    
    $sql = "INSERT INTO trimite_primeste_mesaj (user_trimite, user_primeste, mesaj) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    $sessionUser = $_SESSION['sessionUser'];

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }

    $message = $_POST['message'];
    if(!$message) {
        header("Location: ../index.php?error=messageempty");
        exit();
    }
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); //XSS Protection

    mysqli_stmt_bind_param($stmt, "sss", $sessionUser, $_POST['user'], $message);
    mysqli_stmt_execute($stmt);
    header("Location: ../message.php?succes=messagesent");
    exit();
}
else {
    header("Location: ../index.php");
    exit();
}

?>