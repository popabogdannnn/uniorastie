<?php

if(isset($_POST['submit'])) {
    require 'database.php';
   
    $captcha = $_POST['g-recaptcha-response'];
    $secretkey = "6LcjKvkZAAAAAOMFeFnXG0z3-A41aoYZPIca6lH-";
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . urlencode($secretkey) . "&response=" . urlencode($captcha);

    $response = file_get_contents($url);
    $responseKey = json_decode($response, TRUE);
    
    if(!$responseKey['success']) {
        header("Location: ../index.php");
        exit();        
    }

    $username = $_POST['username'];
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPassword'];
   
    if(empty($username) || empty($password) || empty($confirmPass) || empty($email) || empty($nume) || empty($prenume)) {
        header("Location: ../register.php?error=emptyfields&username=" . $username . "&email=".$email);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*/", $username)) {
        header("Location: ../register.php?error=invalidusername&username=" . $username);
        exit();
    }
    elseif ($password !== $confirmPass) {
        header("Location: ../register.php?error=passwordsdonotmatch&username=" . $username);
        exit();
    }
    else {
        $sql = "SELECT username FROM utilizatori WHERE username = ? OR email = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../register.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);
            
            if($rowCount > 0) {
                header("Location: ../register.php?error=usernameoremailtaken");
                exit();
            }
            else {
                $sql = "INSERT INTO utilizatori (username, email, nume, prenume, password, privilege, vkey, verificat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../register.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    $privilege = 2;
                    $verificat = 0;
                    $vkey = md5(time() . $username);

                    $to = $email;
                    $subject = "Verificare Email";
                    $message = "<a href=http://". $domain ."/verify.php?vkey=$vkey>Înregistrare cont</a>";
                    $headers = "From: popa_bogdanioan@yahoo.com";
                    $headers .= "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";    
                    
                    if(mail($to, $subject, $message, $headers)) {
                        mysqli_stmt_bind_param($stmt, "sssssisi", $username, $email, $nume, $prenume, $hashedPass, $privilege, $vkey, $verificat);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../register-success.php?success=registered");
                        exit();
                    }
                    else {
                        header("Location: ../register-success.php?error=mailnotsent");
                        exit();
                    }
                    
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: ../index.php");
    exit();
}

?>