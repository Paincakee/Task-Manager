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

$taskName = $_POST['taskName'];
$date = $_POST['taskDate'];
$taskDescription = $_POST['taskDescription'];
$creatorId = $_SESSION['id'];
$completed = false;
if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}


// Insert the data into the database
$sql = "INSERT INTO `tasks`(`id`, `taskName`, `date`, `taskDescription`, `creatorId`, `completed`) VALUES (null, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssssi", $taskName, $date, $taskDescription, $creatorId, $completed ); 

if ($stmt->execute()) {
    echo 'Created';
} else {
    echo 'Error inserting data: ' . $mysqli->error;
}

