<?php
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

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];

if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}

// Check if email already exists in the database
$sql = "SELECT * FROM `account` WHERE `email` = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email already exists, return an error message
    http_response_code(409);
    echo 'Email already exists in the database!';
    die();
}

// Insert the data into the database
$sql = "INSERT INTO `account`(`id`, `firstname`, `lastname`, `email`, `password`) VALUES (null, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssss", $firstname, $lastname, $email, $password);

if ($stmt->execute()) {
    echo 'Data inserted successfully!';
} else {
    echo 'Error inserting data: ' . $mysqli->error;
}
