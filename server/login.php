<?php
require_once 'database.php'; // Include the database connection file

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['username']) && isset($data['password'])) {
        $username = $data['username'];
        $password = $data['password'];

        // Prepare the statement
        $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
        if ($stmt === false) {
            echo json_encode(['message' => 'Database error: Unable to prepare statement']);
            exit;
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if ($row['password'] === $password) {
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

        // Close the statement
        $stmt->close();
    } else {
        // Handle missing username or password
        // You can return a JSON response indicating failure
        echo json_encode(['message' => 'Missing username or password']);
    }
}

// Close the database connection
$connection->close();
?>
