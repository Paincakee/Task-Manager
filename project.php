<?php
include('api/navbar.php');

if (isset($_GET['id'])) {
    $_SESSION['task_id'] = $_GET['id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explain Task</title>
    <link rel="stylesheet" href="styles/form.css">
</head>
<body onload="getData();">
<?=navbar();?>
    
    <script src="js/account/logout.js"></script>
</body>
</html>