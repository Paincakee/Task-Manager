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
        <title>Tasks</title>
        <link rel="stylesheet" href="styles/form.css">
    </head>
    <body id="project-body" onload="">
        <?=navbar();?>

        <a id='createTask-btn' href="createProject.php">New Project</a>

        <div id="projects-collection"></div>



        <script src="js/account/logout.js"></script>

    </body>
</html>
    

