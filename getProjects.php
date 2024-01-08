<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("config/config.php");

    // Fetch projects from the database
    $sql = "SELECT shortCode, projectName, startDate, deadLine, projectCategory, projectMembers FROM projects";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr>
                <th>Short Code</th>
                <th>Project Name</th>
                <th>Start Date</th>
                <th>Dead Line</th>
                <th>Project Category</th>
                <th>Project Members</th>
            </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['shortCode']}</td>
                    <td>{$row['projectName']}</td>
                    <td>{$row['startDate']}</td>
                    <td>{$row['deadLine']}</td>
                    <td>{$row['projectCategory']}</td>
                    <td>{$row['projectMembers']}</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
} else {
    // Return an error message or handle the situation accordingly
    echo "Invalid request method";
}
?>
