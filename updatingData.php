<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config/config.php");

// Starting the session
session_start();

// Initialize the response array
$response = [];

// Check if the form has been submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];
    $country_name = $_POST['countryName'];
    $phone_number = $_POST['phoneNb'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['dateOfBirth'];
    $about = $_POST['bio'];
    $phone_code = isset($_POST['phoneCode']) ? $_POST['phoneCode'] : ''; // Handle empty phone_code

    // Check if the user is logged in
    if (!isset($_SESSION['userID'])) {
        $response['message'] = "User not logged in";
        echo json_encode($response);
        exit();
    }

    // Get user_id from the session
    $userID = $_SESSION['userID'];

    // Update user_profile table with prepared statement
    $sql_update_profile = "UPDATE users
                           SET firstName = ?,
                               lastName = ?,
                               email = ?,
                               countryName = ?,
                               phoneNb = ?,
                               gender = ?,
                               dateOfBirth = ?,
                               bio = ?,
                               phoneCode = ?
                           WHERE userID = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql_update_profile);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssssi", $firstname, $lastname, $email, $country_name, $phone_number, $gender, $date_of_birth, $about, $phone_code, $userID);

    // Execute the update query
    $result_update_profile = mysqli_stmt_execute($stmt);

    if ($result_update_profile) {
        // Update successful
        $response['message'] = "Profile updated successfully";
    } else {
        // Update failed
        $response['error'] = "Error updating profile: " . mysqli_error($conn);
        $response['query'] = $sql_update_profile; // Output the query for debugging
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Form not submitted using the POST method
    $response['message'] = "Form not submitted";
}

// Output the response as JSON
echo json_encode($response);
?>
