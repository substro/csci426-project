<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/styles/sign-up.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form id="signup-form" action="sUp.php" method="post" onsubmit="submitForm()">
                <h2 class="form-title">Sign Up</h2>
                <div class="form-group">
                    <label for="firstName">First Name *:</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name *:</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email *:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password *:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Sign Up</button>
            </form>
            <p>Already have an account? <a href="sign-in.php">Sign In</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        function submitForm() {
            // Perform an AJAX form submission
            $.ajax({
                type: 'POST',
                url: $('#signup-form').attr('action'),
                data: $('#signup-form').serialize(),
                dataType: 'json',
                success: function (response) {
                    if ($.isEmptyObject(response)) {
                        // Redirect to base.php upon successful signup
                        window.location.href = "base.php";
                    } else {
                        // Handle error messages if needed
                        console.log(response);
                    }
                }
            });
            return false; // Prevent the form from submitting normally
        }
    </script>

</body>

</html>
