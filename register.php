<?php
require_once 'includes/header.php';

?>

<div>
    <h1>Register</h1>
    <p>Already have an account? <a href="login.php">Login!</a></p>

    <form action="includes/register-inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="nume" placeholder="Nume">
        <input type="text" name="prenume" placeholder="Prenume">
        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirmPassword" placeholder="Confirm password">
        <div class="g-recaptcha" data-sitekey="6LcjKvkZAAAAAETAbcPT3eWWVDcphO3s872yrCN3"></div>
         <br/>
        <button type="submit" name="submit">REGISTER</button>
    </form>
</div>
<?php
require_once 'includes/footer.php';
?>
