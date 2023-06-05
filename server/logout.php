<?php

require_once 'database.php'; // Include the database connection file

// Handle logout request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // logout logic
    // For example, destroy session data or invalidate JWT token
    // You can return a JSON response indicating success
    echo json_encode(['message' => 'Logout successful']);
}

$connection->close();

?>