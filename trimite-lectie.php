<?php

require_once 'includes/header.php';

if(!isset($_SESSION['sessionId']) && $_SESSION['privilege'] != 1) {
    header("Location: index.php?error=insufficientrights");
    exit();
}

?>

<form action="includes/trimite-lectie-inc.php" method="post" enctype="multipart/form-data">
        <input type="text" name="idgrupa" placeholder="Grupa">
        <input type="file" name="fisier" accept="video/mp4">
        <input type="submit" name="submit" value="Trimite">
</form>



<?php

require_once 'includes/footer.php';

?>
