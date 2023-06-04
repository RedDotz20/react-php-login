<?php

session_start();
require_once 'database.php';

// Function to validate user credentials
function validateUser($username, $password) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return false;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = validateUser($username, $password);

    if ($user) {
        // Set user data in session
        $_SESSION['user'] = $user;

        // Redirect to protected content or any other page
        header('Location: protected.php');
        exit();
    } else {
        // Invalid credentials, redirect to login page with error
        header('Location: login.html?error=1');
        exit();
    }
}

?>