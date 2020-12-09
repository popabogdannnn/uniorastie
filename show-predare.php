<?php

require_once 'includes/header.php';

?>

<?php

if(isset($_SESSION['sessionId']) && $_SESSION['privilege'] === 1) {

    $ans = getFromTableBy($conn, "preda_la_grupa", "profesor_username", $_SESSION['sessionUser']);
    foreach($ans as $key => $value) {
        echo $value['grupaID'] . " " . $value['nume_materie'];
        echo "<br>";
    }
}

?>

<?php

require_once 'includes/footer.php';

?>
