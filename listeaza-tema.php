<?php

require_once 'includes/header.php';

if(!isset($_SESSION['sessionId']) && ($_SESSION['privilege'] === 1 || $_SESSION['privilege'] === 3)) {
    header("Location: index.php?error=insufficientrights");
    exit();
}
?>

<?php

    $temaID = $_GET['temaid'];
    $privilege = $_SESSION['privilege'];
    $ans = getFromTableBy($conn, "primeste_tema", "temaID", $temaID);
    $username = $_SESSION['sessionUser'];
    
    if(count($ans) == 0) {
        header("Location: index.php?error=temainexistenta");
        exit();
    }

    $row = $ans[0];

    if(!($username == $row['profesor_username'] || $username == $row['student_username'])) {
        header("Location: index.php?error=insufficientrights");
        exit();
    }

    $deadline = strtotime($row['deadline']);

    $cerinta = "Cerință <br>";
    $cerintaText = "<textarea type='text' name='cerinta' placeholder='Cerință'";
    if($privilege === 3 || $deadline < time()) {
        $cerintaText = $cerintaText . "readonly";
    }
    $cerintaText = $cerintaText . ">";
    $cerintaText = $cerintaText . $row['cerinta'] . "</textarea> <br>";
    $cerinta = $cerinta . $cerintaText;

    $submisie = "Submisie <br>";
    
    $submisieText = "<textarea type='text' name='submisie' placeholder='Submisie'";
    if($privilege === 1 || $deadline < time()) {
        $submisieText = $submisieText . "readonly";
    }
    $submisieText = $submisieText . ">";
    $submisieText = $submisieText . $row['submisie'] . "</textarea> <br>";

    $submisie = $submisie . $submisieText;


    $nota = "Nota <br>";
    $vnota = $row['nota'];
    $notaText = "<input type='number' name='nota' placeholder='Nota' value='$vnota' min='0' max='10'";
    if($privilege === 3) {
        $notaText = $notaText . "readonly";
    }

    $notaText = $notaText . ">";

    $nota = $nota . $notaText;


    echo '<form action="includes/update-tema-inc.php?temaid=' . $temaID . '" method="post">' . $cerinta . $submisie . $nota . '<button type="submit" name="submit">Update</button> </form>';
?>

<?php

require_once 'includes/footer.php';

?>
