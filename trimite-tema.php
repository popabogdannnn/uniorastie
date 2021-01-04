<?php

require_once 'includes/header.php';

if(!isset($_SESSION['sessionId'])) {
    header("Location: index.php?error=insufficientrights");
    exit();
}

?>

<form action="includes/trimite-tema-inc.php" method="post">
        <input type="text" name="idgrupa" placeholder="Grupa">
        <textarea type="text" name="cerinta" placeholder="Cerință"></textarea>
        <input type="datetime-local" name="deadline">
        <button type="submit" name="submit">Trimite</button>
</form>



<?php

require_once 'includes/footer.php';

?>
