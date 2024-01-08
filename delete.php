<?php
session_start();
include("config/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['projectID'])) {
    $projectID = $_POST['projectID'];

    // Prepare and execute the SQL query to delete the project
    $deleteSql = "DELETE FROM projects WHERE projectID = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $projectID);
    
    if ($stmt->execute()) {
        $response = array('success' => true, 'message' => 'Project deleted successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error deleting project');
    }

    $stmt->close();
    $conn->close();

    // Return the JSON response
    echo json_encode($response);
} else {
    // Return an error message or handle the situation accordingly
    $response = array('success' => false, 'message' => 'Invalid request');
    echo json_encode($response);
}
?>
