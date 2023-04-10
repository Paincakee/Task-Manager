<?php
include('api/navbar.php');
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>
<?=navbar();?>
    <form id="register-form" action="" method="post">
        <input type="text" name="firstname" id="firstname-register-txb" placeholder="First name" required>
        <input type="text" name="lastname" id="lastname-register-txb" placeholder="Last name" required>
        <input type="email" name="email" id="email-register-txb" placeholder="Email" required>
        <input type="password" name="password" id="password-register-txb" placeholder="Password" required>
        <input type="submit" value="Create Account"/>
        <span id="error-text"></span>
    </form>



    <script src="js/register.js"></script>
</body>
</html>