<?php

require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$json = file_get_contents('php://input');
	$data = json_decode($json, true);

	if (isset($data['username']) && isset($data['password'])) {
		$username = $data['username'];
		$password = $data['password'];

		$stmt = $connection->prepare('SELECT * FROM users WHERE username = ?');
		if ($stmt === false) {
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
				echo json_encode(['message' => 'Login successful']);
			} else {
				echo json_encode(['message' => 'Invalid credentials']);
			}
		} else {
			echo json_encode(['message' => 'User not found']);
		}

		$stmt->close();
	} else {
		echo json_encode(['message' => 'Missing username or password']);
	}
}

$connection->close();

?>
