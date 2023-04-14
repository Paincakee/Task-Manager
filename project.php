<?php
include('api/navbar.php');

if(isset($_GET['project_id'])){
  $_SESSION['project_id'] = $_GET['project_id'];
  // $projectId = $_GET['project_id'];
  $projectName = $_GET['project_name'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$projectName?></title>
    <link rel="stylesheet" href="styles/form.css">
</head>
<body onload="getTasks();">
<?=navbar();?>
    <a id='createTask-btn' href="createTask.php?project_id=<?=$_SESSION['project_id']?>">New Task</a>
   
    <div id="tasks"></div>
    <script src="js/account/logout.js"></script>
    <script src="js/tasks/showTask.js"></script>
</body>
</html>