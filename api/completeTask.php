<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(400);
    die();
}
if (isset($_SESSION['task_id'])) {
    $id = $_SESSION['task_id'];
    // echo $id;
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'task_manager';

// Create a new mysqli object
$mysqli = new mysqli($host, $username, $password, $database);

$completed = true;

if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}


// Insert the data into the database
$sql = "UPDATE `tasks` SET `completed`=? WHERE `id`=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $completed, $id);

if ($stmt->execute()) {
    echo 'Completed';
} else {
    echo 'Error inserting data: ' . $mysqli->error;
}