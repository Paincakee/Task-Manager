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
    <title>Login</title>
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>
    <?=navbar();?>
    <form id="login-form" action="" method="post">
        <input type="text" name="email" id="email-login-txb" placeholder="Email">
        <input type="password" name="password" id="password-login-txb" placeholder="Password">
        <input type="submit" value="Log In"/>
        <span id="error-text"></span>
    </form>

    <script src="js/account/login.js"></script>
</body>
</html>