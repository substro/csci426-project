<?php
include("config.php");

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
        $sql = "INSERT INTO project(shortCode, projectName, startDate, deadLine, projectCategory, projectMembers) 
                VALUES('$shortCode','$projectName','$startDate','$deadLine','$projectCategory','$projectMembers')";

        if (mysqli_query($conn, $sql)) {
            echo "Data inserted successfully";
            
        } else {
            echo "Error: Unable to save data to the database.";
        }
    }

    mysqli_close($conn);
}
?>
