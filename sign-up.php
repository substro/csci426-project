<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include "./config/config.php";

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
	$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
	$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];

	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	$dateCreated = date('Y-m-d H:i:s');

	if (empty($firstName)) {
		$errors['firstName'] = "First name is required";
	}
	if (empty($lastName)) {
		$errors['lastName'] = "Last name is required";
	}
	if (empty($email)) {
		$errors['email'] = "Email is required";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Invalid email format';
	}
	if (empty($password)) {
		$errors['password'] =  "Password is empty!";
	} elseif (strlen($password) < 8) {
		$errors['password'] = 'Password should be at least 8 characters long';
	}

	if (empty($errors)) {
		$checkQuery = "SELECT COUNT(*) AS count FROM users WHERE email = ?";
		$checkStmt = $conn->prepare($checkQuery);
		$checkStmt->bind_param("s", $email);
		$checkStmt->execute();
		$result = $checkStmt->get_result()->fetch_assoc();
		$checkStmt->close();

		if ($result['count'] > 0) {
			$errors['email'] = "Email already in use";
			echo json_encode($errors);
			exit();
		}

		$insertQuery  = "INSERT INTO users (firstName, lastName, email, password, date_created) VALUES (?, ?, ?, ?, ?)";
		$insertStmt = $conn->prepare($insertQuery);
		$insertStmt->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $dateCreated);

		$insertStmt->execute();
		$insertStmt->close();

		// Redirect to the home page after successful signup
		header("Location: home.php");
		exit();
	} else {
		echo json_encode($errors);
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link rel="stylesheet" href="./assets/styles/sign-up.css">
	<link rel="stylesheet" href="./assets/styles/reset.css">

</head>

<body>
	<div class="container">
		<div class="form-container">
			<form id="signup-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<h2 class="form-title">Sign Up</h2>
				<div class="form-group">
					<label for="firstName">First Name *:</label>
					<input type="text" id="firstName" name="firstName" required>
				</div>
				<div class="form-group">
					<label for="lastName">Last Name *:</label>
					<input type="text" id="lastName" name="lastName" required>
				</div>
				<div class="form-group">
					<label for="email">Email *:</label>
					<input type="email" id="email" name="email" required>
				</div>
				<div class="form-group">
					<label for="password">Password *:</label>
					<input type="password" id="password" name="password" required>
				</div>
				<button type="submit">Sign Up</button>
			</form>
			<p>Already have an account? <a href="sign-in.php">Sign In</a></p>
		</div>
	</div>

	<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

	<script>
		$(document).ready(function() {
			$('.signup-form').submit(function(event) {
				event.preventDefault(); // Prevent form submission

				// Perform an AJAX form submission
				$.ajax({
					type: $(this).attr('method'),
					url: $(this).attr('action'),
					data: $(this).serialize(),
					dataType: 'json',
					success: function(response) {
						if (response.userExists === 1) {
							// Redirect to home.php upon successful login
							window.location.href = "home.php";
						} else {
							// Handle error messages if needed
							console.log(response.message);
						}
					}
				});
			});
		});
	</script> -->

</body>

</html>