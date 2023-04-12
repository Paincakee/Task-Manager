<?php
session_start();

// Generate the HTML table based on the current leaderboard data
if (!isset($_SESSION['data'])) {
    // If there's no leaderboard data, display a message
    echo '<p>No Task Made</p>';
} else {

    foreach($_SESSION['data'] as $data) {
        ?>
        <div class="task-wrapper" data-task-id="<?=$data['id']?>">
            <div class="dateName-wrapper">
                <div class="task-name"><?=$data['taskName']?> </div>
                <div class="task-date"><?=$data['date']?></div>
            </div>
            <div class="task-description"><?=$data['taskDescription']?></div>
            <div class="task-delete"><a href="https://github.com/Paincakee/Task-Manager" class="delete-task">✖</a></div>
        </div>
        <?php 
    } 
}

