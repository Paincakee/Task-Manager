<?php
include('api/navbar.php');
if(!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="styles/form.css">
    </head>
    <body onload="">
        <?=navbar();?>
        Hello
        <?=htmlspecialchars($_SESSION['username'] . '#' . $_SESSION['user_code'] . " Id:" . $_SESSION['id'])?>
        
        
        <script src="js/account/logout.js"></script>
    </body>
</html>
    

