<?php
session_start();

// Generate the HTML table based on the current leaderboard data
if (!isset($_SESSION['dataProject'])) {
    // If there's no leaderboard data, display a message
    echo '<p>No Task Made</p>';
} else {

    foreach($_SESSION['dataProject'] as $data) {
        ?>
        <div class="projects-wrapper" data-project-id="<?=$data['project_id']?>" data-project-name="<?=$data['project_name']?>">
            <div class="projectName-wrapper">
                <div class="project-name"><?=$data['project_name']?> </div>
                <div class="project-description"><?=$data['project_description']?> </div>
            </div>
            <div class="project_contributors">contributors ID: <?=$data['contributors']?></div>
        </div>
        <?php 
    } 
}

