<?php
require_once 'db.php'; // Include the database connection file

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from the database (replace 'users' with your table name)
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $connection->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Verify password (replace 'password_hash' with the column name where passwords are stored)
        if (password_verify($password, $storedPassword)) {
            // Perform successful login logic
            // For example, start a session or generate a JWT token
            // You can return a JSON response indicating success
            echo json_encode(['message' => 'Login successful']);
        } else {
            // Handle invalid credentials
            // You can return a JSON response indicating failure
            echo json_encode(['message' => 'Invalid credentials']);
        }
    } else {
        // Handle user not found
        // You can return a JSON response indicating failure
        echo json_encode(['message' => 'User not found']);
    }
}

$connection->close();

?>