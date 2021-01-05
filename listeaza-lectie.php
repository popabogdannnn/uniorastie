<?php



require_once 'includes/header.php';

if(!isset($_SESSION['sessionId']) && ($_SESSION['privilege'] === 1 || $_SESSION['privilege'] === 3)) {
    header("Location: index.php?error=insufficientrights");
    exit();
}
?>

<?php

    $id = $_GET['id'];
    $privilege = $_SESSION['privilege'];
    $ans = getFromTableBy($conn, "trimite_lectie", "id", $id);
    $username = $_SESSION['sessionUser'];
    
    if(count($ans) == 0) {
        header("Location: index.php?error=lectieinexistenta");
        exit();
    }
    
    $row = $ans[0];

    $ans = getFromTableBy($conn, "studenti", "username", $username);

    if(!($username == $row['profesor_username'] || $ans[0]['grupaID'] == $row['grupaID'])) {
        header("Location: index.php?error=insufficientrights");
        exit();
    }

    $nume = $row['nume'];
    echo "<h3>Lecția: " . $nume . "</h3>";

?>


<video width="600" controls>

    <source src="videos/<?php echo $nume; ?>" type="video/mp4">
</video>

<?php

require_once 'includes/footer.php';
?>
