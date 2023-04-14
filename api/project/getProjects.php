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

$contributorIds = "";
foreach ($data as $row) {
    $contributorIds .= $row['id'] . ",";
}

// Remove the trailing comma
$contributorIds = rtrim($contributorIds, ",");

// Build the query to fetch data for the selected difficulty
$query = "SELECT * FROM `projects` WHERE `creator` = '$creatorId' OR FIND_IN_SET('$contributorIds', `contributor`)";


// Execute the query
$result = $mysqli->query($query);

// Check for errors
if (!$result) {
    die('Failed to retrieve data from the projects table: ' . $mysqli->error);
}

// Fetch all data as an associative array
$data = $result->fetch_all(MYSQLI_ASSOC);

// Store the data in the session
$_SESSION['dataProject'] = $data;

// Free the result set
$result->free();

// Set the response header to indicate that the response contains JSON data
header('Content-Type: application/json');

// Return the data as JSON
echo json_encode($_SESSION['dataProject']);
