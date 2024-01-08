<?php
session_start();
include("config/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch projects from the database
    $sql = "SELECT projectID, shortCode, projectName, startDate, deadLine, projectCategory, projectMembers FROM projects";
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
                <th>Delete</th>
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
                    <td><button class='delete-btn' data-projectid='{$row['projectID']}'>Delete</button></td>
                </tr>";
        }

        echo "</table>";

        // Include jQuery (you may need to adjust the path based on your file structure)
        echo "<script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>";

        // Add the JavaScript/jQuery code to handle delete button click
        echo "<script>
            $(document).ready(function() {
                $('.delete-btn').click(function() {
                    var projectID = $(this).data('projectid');
                    if (confirm('Are you sure you want to delete this project?')) {
                        // Make an AJAX request to delete.php to delete the project
                        $.post('delete.php', { projectID: projectID }, function(data) {
                            var response = JSON.parse(data);
                            if (response.success) {
                                // Reload the page or update the table as needed
                                location.reload();
                            } else {
                                alert('Error deleting project: ' + response.message);
                            }
                        });
                    }
                    return false; // prevent the default behavior of the button
                });
            });
        </script>";
    } else {
        echo "0 results";
    }

    $conn->close();
} else {
    // Return an error message or handle the situation accordingly
    echo "Invalid request method";
}
?>
