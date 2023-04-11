<?php
include('api/navbar.php');
$month = date('m');
$year = date('Y');

// Get the number of days in the month
$numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);


// Loop through each day in the month



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>
    <?=navbar();?>
    
    <div class="date-container">
    <?php
    for ($day = 1; $day <= $numDays; $day++) {
    // Create a block for the day
    ?>
    <div class='date-block'><?=$day?></div>

    
    <?php 
    } 
    ?>
    </div>

</body>
</html>