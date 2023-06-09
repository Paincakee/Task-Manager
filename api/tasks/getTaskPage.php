<?php
session_start();

if (isset($_SESSION['task_id'])) {
    $id = $_SESSION['task_id'];
}
else{
    error_log(404);
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'task_manager';

// Create a new mysqli object
$mysqli = new mysqli($host, $username, $password, $database);

// Check for errors
if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}
// $id = 2;

$query = "SELECT * FROM `tasks` WHERE `id` = $id";

// Execute the query
$result = $mysqli->query($query);

// Check for errors
if (!$result) {
    die('Failed to retrieve data from the leaderboard table: ' . $mysqli->error);
}

// Fetch all data as an associative array
$data = $result->fetch_all(MYSQLI_ASSOC);

// Store the data in the session
$_SESSION['dataId'] = $data;
// var_dump($_SESSION['dataId'][0]['completed']);
if ($_SESSION['dataId'][0]['completed'] == 0) {
    
    
    echo '<button id="complete-btn">Complete task</button>';
    
    
    
}


// Free the result set
$result->free();

// Set the response header to indicate that the response contains JSON data
header('Content-Type: application/json');

// Return the data as JSON
// echo json_encode($data);
// var_dump($data);
