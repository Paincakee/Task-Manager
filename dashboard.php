<?php
session_start();

if ($_SESSION['loggedIn']) {
    // User is logged in, display content
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logged In</title>
    </head>
    <body>
        You are logged in
        <?=$_SESSION['firstname']?>
        <?=$_SESSION['lastname']?>
        <?=$_SESSION['user']?>
        <button id="logout-btn">Logout</button>
    </body>
    </html>
    <script src="js/logout.js"></script>
<?php
} else {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit;
}
?>
