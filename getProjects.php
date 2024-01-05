<?php
// getProjects.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("config.php");

    // Fetch projects from the database
    $sql = "SELECT shortCode, projectName, startDate, deadLine, projectCategory, projectMembers FROM projects";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<p>{$row['shortCode']} - {$row['projectName']} - {$row['startDate']} - {$row['deadLine']} - {$row['projectCategory']} - {$row['projectMembers']}</p>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
} else {
    // Return an error message or handle the situation accordingly
    echo "Invalid request method";
}
?>