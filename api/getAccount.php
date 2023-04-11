<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(400);
    die();
}

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

// Prepare the query
$query = "SELECT * FROM `account` WHERE `email` = ?";
$stmt = $mysqli->prepare($query);

// Bind the parameters
$stmt->bind_param("s", $email);

// Execute the query
if (!$stmt->execute()) {
    die('Failed to retrieve data from the account table: ' . $mysqli->error);
}

// Get the result set
$result = $stmt->get_result();

// Check if email exists
if ($result->num_rows == 0) {
    http_response_code(409);
    die('Invalid email or password. Please try again.');
}

// Get the user data
$userData = $result->fetch_assoc();

// Verify the password
if (!password_verify($passwordForm, $userData['password'])) {
    die('Invalid email or password. Please try again.');
}

// Set the session data
$_SESSION['loggedIn'] = true;
$_SESSION['user'] = $userData['email'];
$_SESSION['firstname'] = $userData['firstname'];
$_SESSION['lastname'] = $userData['lastname'];
$_SESSION['id'] = $userData['id'];

// Free the result set
$result->free();

echo json_encode($_SESSION['loggedIn']);
exit;

?>
