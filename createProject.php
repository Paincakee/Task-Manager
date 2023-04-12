<?php
include('api/navbar.php');


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project Creator</title>
        <link rel="stylesheet" href="styles/form.css">




    </head>
    <body onload="">
        <?=navbar();?>
       
        <form id="createProject-form" action="" method="post">
            <input type="text" id="projectName" name="projectName" placeholder="Project Name">
            <input type="text" name="search" placeholder="Search...">
            <select name="selected[]" multiple></select>

            <textarea name="projectDescription" id="projectDescription" cols="30" rows="10" placeholder="Describe the project"></textarea>
            <input type="submit" value="Create Task">
        </form>
        <script src="js/project/createProject.js"></script>
        <script src="js/account/logout.js"></script>
        <script src="js/project/searchProjectContr.js"></script>
    </body>
</html>
    

