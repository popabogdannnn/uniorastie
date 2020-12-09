<?php

require_once 'includes/header.php';

if(!isset($_SESSION['sessionId'])) {
    header("Location: index.php?error=insufficientrights");
    exit();
}
?>

<?php

$sql = "SELECT messageID, user_trimite, user_primeste, data_trimitere FROM trimite_primeste_mesaj WHERE user_trimite = ? OR user_primeste = ? ORDER BY data_trimitere DESC";
$stmt = mysqli_stmt_init($conn);

$sessionUser = $_SESSION['sessionUser'];

if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?error=sqlerror");
    exit();
}

mysqli_stmt_bind_param($stmt, "ss", $sessionUser, $sessionUser);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$printmessages = "<li><a href=send-message.php>Trimite mesaj</a></li>";

while($row = mysqli_fetch_assoc($result)) { 
    $toConcat = "<li><a href=display-message.php?messageid=" . strval($row['messageID']) . ">";
    $time = strtotime($row['data_trimitere']);
    $viewTime = date("Y-m-d H:i:s", $time);
    if($row['user_primeste'] == $sessionUser) {
        $toConcat = $toConcat . "Primit de la: " . $row['user_trimite'] . " " . $viewTime;
    }
    else {
        $toConcat = $toConcat . "Trimis la: " . $row['user_primeste'] . " " . $viewTime;
    }
    $toConcat = $toConcat . "</a></li>";
    $printmessages = $printmessages . $toConcat;
}

echo $printmessages;


?>

<?php

require_once 'includes/footer.php';

?>
