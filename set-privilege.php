<?php

require_once 'includes/header.php';
 
if($_SESSION['privilege'] !== 0) {
    header("Location: ../index.php?error=insufficientrights");
    exit();
}

?>

<div>
    <form action="includes/set-privilege-inc.php" method="post">
        <input type="text" name="id" placeholder="ID">
        <input type="text" name="privilege" placeholder="Rank">
        <button type="submit" name="submit">set</button>
    </form>
</div>

<?php

require_once 'includes/footer.php';

?>