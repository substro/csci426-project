<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="./assets/styles/sign-in.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Sign In</h2>
            <form id="signin-form" method="post" action="sIn.php">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Sign In</button>
            </form>
            <p>Don't have an account? <a href="sign-up.php">Sign Up</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#signin-form').submit(function (event) {
                event.preventDefault(); // Prevent form submission

                console.log("Form submitted"); // Log to check if the form is being submitted

                // Perform an AJAX form submission
                $.ajax({
                    type: 'POST', // Set the method directly to 'POST'
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.userExists === 1) {
                            // Redirect to home.php upon successful login
                            window.location.href = "base.php";
                        } else {
                            // Handle error messages if needed
                            console.log(response.message);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
