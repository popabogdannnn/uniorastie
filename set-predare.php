<?php

require_once 'includes/header.php';
 
if($_SESSION['privilege'] !== 0) {
    header("Location: ../index.php?error=insufficientrights");
    exit();
}

?>

<div>
    <form action="includes/set-predare-inc.php" method="post">
        <input type="text" name="usernameProf" placeholder="Username profesor">
        <input type="text" name="grupaID" placeholder="Nume Grupa">
        <input type="text" name="materie" placeholder="Nume Materie">
        <button type="submit" name="submit">set</button>
    </form>
</div>

<?php

require_once 'includes/footer.php';

?>