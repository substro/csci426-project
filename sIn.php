<?php

// Set session cookie lifetime
ini_set('session.cookie_lifetime', 86400); // 1 day in seconds

// Set max session lifetime on server
ini_set('session.gc_maxlifetime', 86400);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include "config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST['email'] ?? ''; // Get email from form input
	$password = $_POST['password'] ?? ''; // Get password from form input

	// Validate that email and password are not empty
	if (!empty($email) && !empty($password)) {
		$sql = "SELECT * FROM users WHERE email = ?";
		try {
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('s', $email);
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$storedPassword = $row['password'];
					$userID = $row['userID'];
					// Verify the entered password against the stored hashed password
					if (password_verify($password, $storedPassword)) {
						$_SESSION['userID'] = $userID;
						$response = ['userExists' => 1, 'message' => 'User Exists', 'redirect' => 'base.php'];
					} else {
						$response = ['userExists' => 0, 'message' => 'Invalid password'];
					}
				} else {
					$response = ['userExists' => 0, 'message' => 'User not found'];
				}
			} else {
				$response = ['userExists' => 0, 'message' => 'Error executing query', 'error' => $stmt->error];
			}
		} catch (Exception $e) {
			$response = ['userExists' => 0, 'message' => 'An error occurred', 'error' => $e->getMessage()];
			// Log the error to a file or error tracking system
			error_log("Error: " . $e->getMessage(), 0);
		}
	} else {
		$response = ['userExists' => 0, 'message' => 'Email or password is empty'];
	}

	echo json_encode($response);
	exit(); // Ensure no further output is sent
}
?>
