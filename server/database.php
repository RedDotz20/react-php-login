<?php

$host = "localhost";            // MySQL database host
$username = "your_username";    // MySQL database username
$password = "your_password";    // MySQL database password
$database = "your_database";    // MySQL database name

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>