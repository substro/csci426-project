<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Form</title>
   
</head>
<body>

<form id="projectForm" action="projectAction.php" method="post">

    <h2>Project details</h2>

    <p>short code </p>
    <input type="text" name="shortcode" placeholder="project unique short code">

    <p>Project Name</p>
    <input type="text" name="projectname" placeholder="write a project name">

    <p>start date</p>
    <input type="date" name="startdate">

    <p>deadline</p>
    <input type="date" name="deadline"><br><Br><br>

    <label for="projectCategory">Select Project Category:</label><br>
    <select id="projectCategory" name="projectCategory">
        <option value="value1">option1</option>
        <option value="value2">option2</option>
        <option value="value3">option3</option>
        <option value="value4">option4</option>
    </select><br><br>

    <label for="projectMembers">Select Project Members:</label><br>
    <select id="projectMembers" name="projectmembers">
        <option value="member1">member1</option>
        <option value="member2">member2</option>
        <option value="member3">member3</option>
        <option value="member4">member4</option>
    </select>
    <br><br><br>
    <button type="button" onclick="submitForm()" id="save">Save</button>
    <button type="button" onclick="cancel()">Cancel</button>

</form>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
 function cancel() {
        window.location.href = "projectBase.php";
    }


</script>


<script>
function submitForm() {
    // Get form data
    var formData = $("#projectForm").serialize();

    // Ajax request
    $.ajax({
        type: "POST",
        url: "projectAction.php",
        data: formData,
        success: function(response) {
            // Handle success, if needed
            alert(response);
            window.location.href = "projectBase.php";
        },
        error: function(error) {
            // Handle error, if needed
            alert("Error: " + error.statusText);
        }
    });
}
</script>

</body>
</html>
