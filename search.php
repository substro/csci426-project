<?php
include "config.php";

if (isset($_POST['result'])) {
    $result = $_POST['result'];

    $sql = "SELECT * FROM projects WHERE projectName LIKE '{$result}%'";

    $output = mysqli_query($conn, $sql);

    if (mysqli_num_rows($output) > 0) { ?>

        <table>
            <thead>
                <tr>
                    <th>project ID</th>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>Dead Line</th>
                    <th>Project Category</th>
                    <th>Project Members</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($output)) {
                    $projectID = $row['projectID'];
                    $projectName = $row['projectName'];
                    $startDate = $row['startDate'];
                    $deadLine = $row['deadLine'];
                    $projectCategory = $row['projectCategory'];
                    $projectMembers = $row['projectMembers'];
                    
                    ?>
                    <tr>
                        <td><?php echo $projectID; ?></td>
                        <td><?php echo $projectName; ?></td>
                        <td><?php echo $startDate; ?></td>
                        <td><?php echo $deadLine; ?></td>
                        <td><?php echo $projectCategory; ?></td>
                        <td><?php echo $projectMembers; ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>

    <?php } else {
        echo "<h4>No Data Found!</h4>";
    }
}
?>
