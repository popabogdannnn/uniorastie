<?php

require_once 'includes/header.php';
 
if($_SESSION['privilege'] !== 0) {
    header("Location: ../index.php?error=insufficientrights");
    exit();
}

?>

<div>
    <form action="includes/del-inc.php" method="post">
        <input type="text" name="id" placeholder="ID">
        <button type="submit" name="submit">delete</button>
    </form>
</div>

<?php

require_once 'includes/footer.php';

?>