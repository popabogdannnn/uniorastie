<?php

require_once 'includes/header.php';

?>

<?php
    if(isset($_SESSION['sessionId'])) {
        echo "Buna " . $_SESSION['sessionUser'];
    }
    else {
        echo "Acasă";
    }

?>

<?php

require_once 'includes/footer.php';

?>
