<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config/config.php");

// Ensure the connection to the database is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shortCode = $_POST["shortcode"];
    $projectName = $_POST["projectname"];
    $startDate = $_POST["startdate"];
    $deadLine = $_POST["deadline"];
    $projectCategory = $_POST["projectCategory"];
    $projectMembers = $_POST["projectmembers"];

    if (empty($shortCode) || empty($projectName) || empty($startDate) || empty($deadLine) || empty($projectCategory) || empty($projectMembers)) {
        echo "All fields are required";
    } elseif (strtotime($deadLine) <= strtotime($startDate)) {
        echo "The deadline cannot be shorter than or equal to the start date";
    } else {
        $sql = "INSERT INTO projects(shortCode, projectName, startDate, deadLine, projectCategory, projectMembers) 
                VALUES('$shortCode','$projectName','$startDate','$deadLine','$projectCategory','$projectMembers')";

        if (mysqli_query($conn, $sql)) {
            echo "Data inserted successfully";
        } else {
            echo "Error: Unable to save data to the database. " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>
