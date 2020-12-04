<?php

require_once 'includes/header.php';

if($_SESSION['privilege'] !== 0) {
    header("Location: index.php?error=insufficientrights");
    exit();
}



$sql = "SELECT userID, username, privilege FROM Utilizatori";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?error=sqlerror");
    exit();
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while($row =  mysqli_fetch_assoc($result)) {
    echo "userID: " . $row['userID'] . " username: " . $row['username'] . " privilege: " . $row['privilege'] . "<br>";
}



require_once 'includes/footer.php';

?>