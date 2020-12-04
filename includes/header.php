<?php
    session_start();
    require_once 'database.php';
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <?php
                if(!isset($_SESSION['sessionId'])) { ?>
                    <li><a href="index.php">Acasă</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
             <?php } 
                else {
                
                 if($_SESSION['privilege'] === 0) { ?>
                    <li><a href="view-users.php">Utilizatori</a></li>
                    <li><a href="set-privilege.php">Setează privilege</a></li>
                    <li><a href="del.php">Șterge</a></li>
                        
                 <?php   } ?>
                 <li><a href="message.php">Mesaje</a></li> 
                 <li><a href="logout.php">Logout</a></li>
                    
             <?php }?> 
        </ul>
    </nav>

</header>