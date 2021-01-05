<?php
    session_start();
    require_once 'database.php';
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>UO</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<div id="page-container">

<header>
    <nav>
            <?php
                if(isset($_SESSION['sessionId'])) {
                    if($_SESSION['privilege'] === 0) {
                        echo '<p class="role">Administrator</p>';
                    }
                    if($_SESSION['privilege'] === 1) {
                        echo '<p class="role">Profesor</p>';
                    }
                    if($_SESSION['privilege'] == 3) {
                        echo '<p class="role">Student</p>';
                    }
                }
            ?>
        
        <ul>
            <?php
                if(!isset($_SESSION['sessionId'])) { ?>
                    <li><a href="index.php">Acasă</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
             <?php } 
                else {
                ?>
                    <li><a href="index.php">Acasă</a></li>
                <?php
                 if($_SESSION['privilege'] === 1) {
                    echo '<li><a href="show-predare.php">Predați la</a></li>';
                    echo '<li><a href="trimite-tema.php">Trimiteți temă</a></li>';
                    echo '<li><a href="lista-teme.php">Teme trimise</a></li>';
                    echo '<li><a href="trimite-lectie.php">Trimiteți lecție</a></li>';
                    echo '<li><a href="lista-lectii.php">Lecții trimise</a></li>';
                }

                 if($_SESSION['privilege'] === 3) {
                    echo '<li><a href="show-grupa.php">Grupa mea</a></li>';
                    echo '<li><a href="lista-teme.php">Temele mele</a></li>';
                    echo '<li><a href="lista-lectii.php">Lecții primite</a></li>';
                 }
                

                 if($_SESSION['privilege'] === 0) { ?>
                    <li><a href="view-users.php">Utilizatori</a></li>
                    <li><a href="set-privilege.php">Setează privilege</a></li>
                    <li><a href="creare-grupa.php">Creează grupă</a></li>
                    <li><a href="set-predare.php">Nouă predare</a></li>
                    <li><a href="del.php">Șterge</a></li>
                        
                 <?php   } ?>
                 <li><a href="message.php">Mesaje</a></li> 
                 <li><a href="logout.php">Logout</a></li>
                    
             <?php }?> 
        </ul>
    </nav>

</header>