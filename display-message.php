<?php

require_once 'includes/header.php';

if(!isset($_SESSION['sessionId'])) {
    header("Location: index.php?error=insufficientrights");
    exit();
}
?>

<?php

$messageID = $_GET['messageid'];

$sql = "SELECT user_trimite, user_primeste, mesaj FROM trimite_primeste_mesaj WHERE messageID = ?";
$stmt = mysqli_stmt_init($conn);

$sessionUser = $_SESSION['sessionUser'];

if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?error=sqlerror");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $messageID);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($result)) {
    if($row['user_trimite'] === $sessionUser || $row['user_primeste'] === $sessionUser) {
        $sent = "Trimis de: " . $row['user_trimite'] . "<br>";
        $received = "Primit de: " . $row['user_primeste'] . "<br>";
        $message = "Mesaj: <br>" . $row['mesaj'];
        echo $sent . $received . $message;
    }
    else {
        header("Location: index.php?error=insufficientrights");
        exit();
    }
}
else {
    header("Location: index.php?error=messageinexistent");
    exit();
}

?>

<?php

require_once 'includes/footer.php';

?>
