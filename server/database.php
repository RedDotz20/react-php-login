<?php

// Database connection details
$host = 'localhost';
$db = 'your_database_name';
$user = 'your_username';
$password = 'your_password';

// Create a database connection
$connection = new mysqli($host, $user, $password, $db);
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

?>