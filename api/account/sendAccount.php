<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request method']);
    die();
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'task_manager';

// Create a new mysqli object
$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to connect to MySQL: ' . $mysqli->connect_error]);
    die();
}

$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    die();
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
    echo json_encode(['error' => 'Email already exists']);
    die();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert the data into the database
$sql = "INSERT INTO `account`(`id`, `firstname`, `lastname`, `email`, `password`) VALUES (null, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssss", $firstname, $lastname, $email, $hashed_password);

if ($stmt->execute()) {
    http_response_code(201);
    echo "Created";
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error inserting data: ']);
}
