<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request method']);
    die();
}

$host = 'localhost';
$root = 'root';
$password = '';
$database = 'task_manager';

// Create a new mysqli object
$mysqli = new mysqli($host, $root, $password, $database);

if ($mysqli->connect_errno) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to connect to MySQL: ' . $mysqli->connect_error]);
    die();
}

$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$username = $firstname . $lastname;

if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($username)) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    die();
}

$code_exists = true;
while ($code_exists) {
    $letters = range('A', 'Z');
    $rand_letters = array_rand(array_flip($letters), 2);
    $rand_numbers = mt_rand(1000, 9999);
    $code = $rand_letters[0] . $rand_letters[1] . $rand_numbers;

    // Check if email and code already exist in the database
    $sql = "SELECT * FROM `account` WHERE `email` = ? OR `user_code` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $email, $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $email_exists = false;
        while ($row = $result->fetch_assoc()) {
            if ($row['email'] === $email) {
                $email_exists = true;
                break;
            }
        }
    
        if ($email_exists) {
            // Email already exists, return an error message
            http_response_code(409);
            echo json_encode(['error' => 'Email already exists']);
            die();
        } else {
            // Generate a new code that does not exist in the database
            do {
                $letters = range('A', 'Z');
                $rand_letters = array_rand(array_flip($letters), 2);
                $rand_numbers = mt_rand(1000, 9999);
                $new_code = $rand_letters[0] . $rand_letters[1] . $rand_numbers;

                $sql = "SELECT * FROM `account` WHERE `user_code` = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("s", $new_code);
                $stmt->execute();
                $result = $stmt->get_result();
            } while ($result->num_rows > 0);
            $code = $new_code;
        }
    } else {
        // Email and code do not exist, insert new account into database
        $friendCode = $username . "#" . $code;
        $code_exists = false;
    }
}



// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert the data into the database
$sql = "INSERT INTO `account`(`id`, `firstname`, `lastname`, `email`, `password`, `username`, `user_code`, `friend_code`) VALUES (null, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sssssss", $firstname, $lastname, $email, $hashed_password, $username, $code, $friendCode);

if ($stmt->execute()) {
    http_response_code(201);
    echo "Created";
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error inserting data: ']);
}
