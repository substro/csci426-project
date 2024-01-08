<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/projectBase.css">
    <title>Document</title>
</head>
<body>
    
<form action="addProject.php" method="post">
    <div>
        Search <input type="text" name="search" id="search">
    </div>
    <br>
    <input type="submit" value="+ Add Project" name="submit"> 
    <br><br>

    <!-- New section to display projects using AJAX -->
    <div id="projectsContainer"></div>

    <div id="searchResult"></div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
           
            function displayProjects() {
                $.ajax({
                    url: "getProjects.php", 
                    method: "POST",
                    success: function (data) {
                        $("#projectsContainer").html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Ajax request failed: " + textStatus, errorThrown);
                    }
                });
            }

            // Initial call to display projects
            displayProjects();

            // Search functionality
            $("#search").keyup(function () {
                var result = $(this).val();

                if (result != "") {
                    $.ajax({
                        url: "search.php",
                        method: "POST",
                        data: { result: result },
                        success: function (data) {
                            $("#searchResult").html(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error("Ajax request failed: " + textStatus, errorThrown);
                        }
                    });
                } else {
                    $("#searchResult").html("");
                }
            });
        });
    </script>

</form>

</body>
</html>
