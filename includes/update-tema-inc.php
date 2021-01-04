<?php
session_start();

if(isset($_POST['submit']) && isset($_SESSION['sessionId']) && ($_SESSION['privilege'] === 1 || $_SESSION['privilege'] === 3)) {
    require 'database.php';
    $temaID = $_GET['temaid'];

    $sql = "UPDATE primeste_tema SET submisie = ?, nota = ?, cerinta = ? WHERE temaID = ?";
    $stmt = mysqli_stmt_init($conn);
    $cerinta = $_POST['cerinta'];
    $submisie = $_POST['submisie'];
    $nota = $_POST['nota'];

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    
    if(!$cerinta) {
        header("Location: ../index.php?error=cerintagoala");
        exit();
    }
   
    $cerinta = htmlspecialchars($cerinta, ENT_QUOTES, 'UTF-8'); //XSS Protection
    $submisie = htmlspecialchars($submisie, ENT_QUOTES, 'UTF-8'); //XSS Protection

    mysqli_stmt_bind_param($stmt, "ssss", $submisie, $nota, $cerinta, $temaID);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?succes=updated");
    exit();
}
else {
    if(!isset($_POST['submit'])) 
    header("Location: ../index.php?error=baginrasata2");
    else
    header("Location: ../index.php?error=baginrasata");
    exit();
}

?>