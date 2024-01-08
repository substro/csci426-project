<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config/config.php";

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Validate input
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || strlen($password) < 8 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['validation'] = "Invalid input data";
    }

    if (empty($errors)) {
        // Check if email already exists
        $checkQuery = "SELECT COUNT(*) AS count FROM users WHERE email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);
        $result = mysqli_fetch_assoc($checkResult);

        if ($result['count'] > 0) {
            $errors['email'] = "Email already in use";
        } else {
            // Insert user data into the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $dateCreated = date('Y-m-d H:i:s');
            $insertQuery = "INSERT INTO users (firstName, lastName, email, password, dateCreated) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', '$dateCreated')";
            $insertResult = mysqli_query($conn, $insertQuery);

            if (!$insertResult) {
                $errors['database'] = "Error inserting data into the database: " . mysqli_error($conn);
            }
        }

        echo json_encode($errors);
        exit();
    } else {
        echo json_encode($errors);
        exit();
    }
}
?>
