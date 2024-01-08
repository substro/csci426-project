<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/addproject.css">
    <title>Your Form</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<form id="projectForm" action="projectAction.php" method="post">

    <h2>Project details</h2>

    <p>Short code</p>
    <input type="text" name="shortcode" placeholder="Project unique short code">

    <p>Project Name</p>
    <input type="text" name="projectname" placeholder="Write a project name">

    <p>Start date</p>
    <input type="date" name="startdate">

    <p>Deadline</p>
    <input type="date" name="deadline"><br><br>

    <label for="projectCategory">Select Project Category:</label><br>
    <select id="projectCategory" name="projectCategory">
        <option value="value1">Option 1</option>
        <option value="value2">Option 2</option>
        <option value="value3">Option 3</option>
        <option value="value4">Option 4</option>
    </select><br><br>

    <label for="projectMembers">Select Project Members:</label><br>
    <select id="projectMembers" name="projectmembers">
        <option value="member1">Member 1</option>
        <option value="member2">Member 2</option>
        <option value="member3">Member 3</option>
        <option value="member4">Member 4</option>
    </select>
    <br><br><br>

    <button type="button" onclick="submitForm()" id="save">Save</button>
    <button type="button" onclick="cancel()">Cancel</button>

</form>

<script>
    function cancel() {
        window.location.href = "projectBase.php";
    }

    function submitForm() {
        var formData = $("#projectForm").serialize();

        $.ajax({
            type: "POST",
            url: "projectAction.php",
            data: formData,
            success: function(response) {
                alert(response);
                window.location.href = "projectBase.php";
            },
            error: function(error) {
                alert("Error: " + error.statusText);
            }
        });
    }
</script>

</body>
</html>
