<?php
session_start();

if(isset($_POST['submit']) && isset($_SESSION['sessionId']) && $_SESSION['privilege'] === 1) {
    require 'database.php';

    $ans = getFromTableBy($conn, "preda_la_grupa", "grupaID", $_POST['idgrupa']);
    $ok = False;
    $sessionUser = $_SESSION['sessionUser'];
    
    foreach($ans as $key => $value) {
        if($value['profesor_username'] === $_SESSION['sessionUser']) {
            $ok = True;
        }
    }

    if($ok === False) {
        header("Location: ../index.php?error=predareinexistenta");
        exit();
    }

    $cerinta = $_POST['cerinta'];
    if(!$cerinta) {
        header("Location: ../index.php?error=cerintagoala");
        exit();
    }
    $cerinta = htmlspecialchars($cerinta , ENT_QUOTES, 'UTF-8'); //XSS Protection

    $deadline = strtotime($_POST['deadline']);
    if($deadline <= time()) {
        header("Location: ../index.php?error=deadlineintrecut");
        exit();
    }

    $ans = getFromTableBy($conn, "studenti", "grupaID", $_POST['idgrupa']);

    if(count($ans) == 0) {
        header("Location: ../index.php?error=grupagoala");
        exit();
    }

    foreach($ans as $key => $value) {
        $sql = "INSERT INTO primeste_tema (profesor_username, student_username, cerinta, deadline) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $sessionUser, $value['username'], $cerinta, date('Y-m-d H:i:s', $deadline));
        mysqli_stmt_execute($stmt);
    }
    
    header("Location: ../index.php?succes=tematrimisa");
    exit();
}
else {
    header("Location: ../index.php");
    exit();
}

?>