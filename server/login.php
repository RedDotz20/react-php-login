<?php

require_once 'database.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$json = file_get_contents('php://input');
	$data = json_decode($json, true);

	if (isset($data['username']) && isset($data['password'])) {
		$username = $data['username'];
		$password = $data['password'];

		$stmt = $connection->prepare('SELECT * FROM users WHERE username = ?');
		if ($stmt === false) {
			http_response_code(500);
			echo json_encode([
				'message' => 'Database error: Unable to prepare statement',
			]);
			exit();
		}

		$stmt->bind_param('s', $username);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows === 1) {
			$row = $result->fetch_assoc();
			if ($row['password'] === $password) {
				http_response_code(200);
				echo json_encode(['message' => 'Login successful']);
			} else {
				http_response_code(401);
				echo json_encode(['message' => 'Invalid credentials']);
			}
		} else {
			http_response_code(404);
			echo json_encode(['message' => 'User not found']);
		}

		$stmt->close();
	} else {
		http_response_code(400);
		echo json_encode(['message' => 'Missing username or password']);
	}
}

$connection->close();

?>
