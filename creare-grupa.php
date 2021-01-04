<?php

require_once 'includes/header.php';
 
if($_SESSION['privilege'] !== 0) {
    header("Location: ../index.php?error=insufficientrights");
    exit();
}

?>

<div>
    <form action="includes/creare-grupa-inc.php" method="post">
        <input type="text" name="idgrupa" placeholder="ID Grupa">
        <button type="submit" name="submit">Creare</button>
    </form>
</div>

<?php

require_once 'includes/footer.php';

?>