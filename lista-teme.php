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
        $ans = getFromTableBy($conn, "primeste_tema", "profesor_username", $username);
    }
    else {
        $ans = getFromTableBy($conn, "primeste_tema", "student_username", $username);
    }

    if(count($ans) == 0) {
        echo "Nu aveți teme!";
    }
    
    $printTeme = "";
    foreach($ans as $key => $value) {
        $toConcat = "<li><a href=listeaza-tema.php?temaid=". strval($value['temaID']) . ">";
        $deadline = $value['deadline'];
        
        if($privilege == 1) {
            $toConcat = $toConcat . "Temă trimisă la studentul: " . $value['student_username'] . " Deadline: " . $deadline; 
        }
        else {
            $toConcat = $toConcat . "Temă primită de la profesorul: " . $value['profesor_username'] . " Deadline: " . $deadline;
        }

        $toConcat = $toConcat . "</a></li>";
        $printTeme = $printTeme . $toConcat;
    }

    echo $printTeme;
?>

<?php

require_once 'includes/footer.php';

?>
