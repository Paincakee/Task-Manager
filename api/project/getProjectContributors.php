<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'task_manager';

// Create a new mysqli object
$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    // Query the database for usernames matching the query
    $results = array();
    $stmt = $mysqli->prepare("SELECT id, friend_code FROM account WHERE friend_code LIKE ?");
    $search_query = "%" . $query . "%";
    $stmt->bind_param("s", $search_query);
    $stmt->execute();
    $stmt->bind_result($id, $usernames);
    while ($stmt->fetch()) {
        $results[$id] = $usernames;
        
    }
    // Return the search results as a JSON response
    header('Content-Type: application/json');
    echo json_encode($results);
    exit;
}