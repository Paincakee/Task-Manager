<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(400);
    die();
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'task_manager';

// Create a new mysqli object
$mysqli = new mysqli($host, $username, $password, $database);

$project_name = $_POST['projectName'];
$contributors = isset($_POST['selected']) ? $_POST['selected'] : [];
$project_description = $_POST['projectDescription'];
$creator_id = $_SESSION['user_code'];

$code_exists = true;
while ($code_exists) {
    $letters = range('A', 'Z');
    $rand_letters = array_rand(array_flip($letters), 2);
    $rand_numbers = mt_rand(1000, 9999);
    $code = $rand_letters[0] . $rand_letters[1] . $rand_numbers;

    // Check if code already exists in the database
    $sql = "SELECT * FROM `projects` WHERE `project_id` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Code already exists, generate a new code
        continue;
    } else {
        // Code does not exist, insert new account into database
        $code_exists = false;
    }
}

if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}

// Convert contributors array to a comma-separated string
$contributors_str = implode(",", $contributors);

// Insert the data into the database
$sql = "INSERT INTO `projects`(`id`, `project_name`, `contributors`, `creator`, `project_id`, `project_description`) VALUES (null, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sssss", $project_name, $contributors_str, $creator_id, $code, $project_description); 

if ($stmt->execute()) {
    echo 'Created';
} else {
    echo 'Error inserting data: ' . $mysqli->error;
}

?>
