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
    <body onload="">
        <?=navbar();?>
       
        <form id="createTask-form" action="" method="post">
            <input type="text" id="taskName" name="taskName" placeholder="Task Name">
            <input type="date" name="taskDate" id="taskDate">
            <textarea name="taskDescription" id="taskDescription" cols="30" rows="10" placeholder="Describe the task"></textarea>
            <input type="submit" value="Create Task">
        </form>
        <script src="js/tasks/createTask.js"></script>
        <script src="js/account/logout.js"></script>
    </body>
</html>
    

