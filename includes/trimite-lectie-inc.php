<?php
session_start();

if(isset($_POST['submit']) && isset($_SESSION['sessionId']) && $_SESSION['privilege'] === 1) {
    require 'database.php';

    $ans = getFromTableBy($conn, "preda_la_grupa", "grupaID", $_POST['idgrupa']);
    $ok = False;
    $sessionUser = $_SESSION['sessionUser'];
    $idgrupa = $_POST['idgrupa'];
    
    foreach($ans as $key => $value) {
        if($value['profesor_username'] === $_SESSION['sessionUser']) {
            $ok = True;
        }
    }

    if($ok === False) {
        header("Location: ../index.php?error=predareinexistenta");
        exit();
    }

    

    $name = $_FILES['fisier']['name'];
    $tmp = $_FILES['fisier']['tmp_name'];
    move_uploaded_file($tmp, "../videos/" . $name);
    $sql = "INSERT INTO trimite_lectie (profesor_username, grupaID, nume) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $sessionUser, $idgrupa, $name);
    mysqli_stmt_execute($stmt);
    
    
    header("Location: ../index.php?succes=$name");
    exit();
  
}
else {
    header("Location: ../index.php");
    exit();
}

?>