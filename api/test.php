<?php
session_start();

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

$creatorId = $_SESSION['user_code'];

// Build the query to fetch data for the selected difficulty
$query = "SELECT `id` FROM `account`";

// Execute the query
$result = $mysqli->query($query);

// Check for errors
if (!$result) {
    die('Failed to retrieve data from the account table: ' . $mysqli->error);
}

// Fetch all data as an associative array
$data = $result->fetch_all(MYSQLI_ASSOC);

// Extract the IDs from the data and concatenate them with commas
$idString = "";
foreach ($data as $row) {
    $idString .= $row['id'] . ",";
}

// Remove the trailing comma
$idString = rtrim($idString, ",");

// Print the ID string
echo $idString;
