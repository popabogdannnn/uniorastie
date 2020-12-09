<?php

require_once 'includes/header.php';

?>

<?php

if(isset($_SESSION['sessionId']) && $_SESSION['privilege'] === 3) {

    $ans = getFromTableBy($conn, "studenti", "username", $_SESSION['sessionUser']);
    echo $ans[0]['grupaID'] . "<br>";
    $ans = getFromTableBy($conn, "studenti", "grupaID", $ans[0]['grupaID']);
    foreach($ans as $key => $value) {
        echo $value['username'];
        echo "<br>";
    }
    
}

else {
    header("Location: index.php");
    exit();
}



?>


<?php

require_once 'includes/footer.php';

?>
