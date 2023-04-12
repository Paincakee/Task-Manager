<?php
include('api/navbar.php');
$month = date('m');
$year = date('Y');
$tasksByDay = array();

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
<body onload="getData();">
    <?=navbar();?>
    
    <div class="date-container">
    <?php
        $tasksByDay = array();
        for ($day = 1; $day <= $numDays; $day++) {
            foreach($_SESSION['data'] as $data) {
                $yearF = substr($data['date'], 0, 4);
                $monthF = substr($data['date'], 5, 2);
                $dayF = substr($data['date'], 8, 2);
                $taskName = $data['taskName'];
                if ($yearF == $year && $monthF == $month && $dayF == $day) {
                    if (!isset($tasksByDay[$day])) {
                        $tasksByDay[$day] = array();
                    }
                    $tasksByDay[$day][] = $taskName;
                }
            }
            ?>
            <div class='date-block'><?=$day?>
                <?php
                if (isset($tasksByDay[$day])) {
                    foreach ($tasksByDay[$day] as $taskName) {
                        ?>
                        <br>
                        <span class="task-span"><?=$taskName?></span>
                        <?php
                    }
                }
                ?>
            </div>
            <?php 
        } 
    ?>
    
    </div>
<script src="js/getAgendaTask.js"></script>
</body>
</html>