<?php
session_start();
$_SESSION['loggedIn'] = false;


$host = 'localhost';
$username = 'root';
$password = '';
$database = 'task_manager';


$email = $_POST['email'];
$passwordForm = $_POST['password'];
// Create a new mysqli object
$mysqli = new mysqli($host, $username, $password, $database);

// Check for errors
if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}

// Build the query to fetch data 
$query = "SELECT * FROM `account`";


// Execute the query
$results = $mysqli->query($query);

// Check for errors
if (!$results) {
    die('Failed to retrieve data from the account table: ' . $mysqli->error);
}

foreach ($results as $result ) { 
    if($result['email'] == $email & $result['password'] == $passwordForm){
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = $result['email'];
        $_SESSION['firstname'] = $result['firstname'];
        $_SESSION['lastname'] = $result['lastname'];
        echo json_encode($_SESSION['loggedIn']);
        exit;
    }
}

// Free the result set
$results->free();

// Set the response header to indicate that the response contains JSON data
header('Content-Type: application/json');
echo json_encode("Invalid email or password.");
