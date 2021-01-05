<?php

require_once 'includes/header.php';

if(!isset($_SESSION['sessionId']) && ($_SESSION['privilege'] === 1 || $_SESSION['privilege'] === 3)) {
    header("Location: index.php?error=insufficientrights");
    exit();
}
?>

<?php

    $privilege = $_SESSION['privilege'];
    $ans = [];
    $username = $_SESSION['sessionUser'];
    
    if($privilege === 1) {
        $ans = getFromTableBy($conn, "trimite_lectie", "profesor_username", $username);
    }
    else {
        $ans2 = getFromTableBy($conn, "studenti", "username", $username);
        $ans = getFromTableBy($conn, "trimite_lectie", "grupaID", $ans2[0]['grupaID']);
    }

    if(count($ans) == 0) {
        echo "Nu aveți lecții primite!";
    }
    
    $printTeme = "";
    foreach($ans as $key => $value) {
        $toConcat = "<li><a href=listeaza-lectie.php?id=". strval($value['id']) . ">";
        
        if($privilege == 1) {
            $toConcat = $toConcat . "Lecție trimisă la grupa: " . $value['grupaID'] . " Nume: " . $value['nume']; 
        }
        else {
            $toConcat = $toConcat . "Lecție primită de la profesorul: " . $value['profesor_username'] . " Nume: " . $value['nume'];
        }

        $toConcat = $toConcat . "</a></li>";
        $printTeme = $printTeme . $toConcat;
    }

    echo $printTeme;
?>

<?php

require_once 'includes/footer.php';

?>
