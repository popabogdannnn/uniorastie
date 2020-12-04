<?php

require_once 'includes/header.php';

if(!isset($_SESSION['sessionId'])) {
    header("Location: index.php?error=insufficientrights");
    exit();
}

?>

<form action="includes/send-message-inc.php?sessionuser=<?php echo $_SESSION['sessionUser']?>" method="post">
        <input type="text" name="user" placeholder="Trimite la">
        <textarea type="text" name="message" placeholder="Mesaj"></textarea>
        <button type="submit" name="submit">Trimite</button>
</form>



<?php

require_once 'includes/footer.php';

?>
