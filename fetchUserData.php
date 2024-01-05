<?php
include("config.php");

// Starting the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

// Get user_id from the session
$userID = $_SESSION['userID'];

// Assuming $conn is your database connection

// Fetch user profile data from the database
$sql_select_profile = "SELECT * FROM users WHERE userID = $userID";
$result_select_profile = mysqli_query($conn, $sql_select_profile);

if ($result_select_profile) {
    // Fetch data as an associative array
    $profile_data = mysqli_fetch_assoc($result_select_profile);

    // Send the data as JSON
    echo json_encode($profile_data);
} else {
    // Error fetching data
    echo json_encode(["error" => "Error fetching profile data: " . mysqli_error($conn)]);
}
?>
