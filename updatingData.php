<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config.php");

// Starting the session
session_start();

// Check if the form has been submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lasttName'];
    $email = $_POST['email'];
    $country_name = $_POST['countryName'];
    $phone_number = $_POST['phoneNb'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['dateOfBirth'];
    $about = $_POST['bio'];
    $profile_pic = $_POST['profileImg'];
    $phone_code = isset($_POST['phoneCode']) ? $_POST['phoneCode'] : ''; // Handle empty phone_code

    

    // Check if the user is logged in
    if (!isset($_SESSION['userID'])) {
        echo "User not logged in";
        exit();
    }

    // Get user_id from the session
    $userID = $_SESSION['userID'];
    // Update user_profile table without prepared statement
    $sql_update_profile = "UPDATE users
                             SET firstName = '$firstname',
                                 lastName = '$lastname',
                                 email = '$email',
                                 countryName = '$country_name',
                                 phoneNb = '$phone_number',
                                 gender = '$gender',
                                 dateOfBirth = '$date_of_birth',
                                 bio = '$bio',
                                 profileImg = '$profile_pic',
                                 phoneCode = '$phone_code'
                           WHERE userID = $userID";

    // Execute the update query
    $result_update_profile = mysqli_query($conn, $sql_update_profile);

    if ($result_update_profile) {
        // Update successful
        echo "Profile updated successfully";
    } else {
        // Update failed
        echo "Error updating profile: " . mysqli_error($conn);
        echo "<br>Query: " . $sql_update_profile; // Output the query for debugging
    }
} else {
    // Form not submitted using the POST method
    echo "Form not submitted";
}
?>


