<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="updatingData.php" method="post" id="settingForm">

<p>username</p>

<input type="text" name="Firstname" id="firstname">
<input type="text" name="lastname" id="lastname">


<p>email</p>

<input type="email" name="email" id="email"> <br><br>

<label for="country">Select Country:</label>
        <select name="country_name" id="country">
            <option value="Lebanon">Lebanon</option>
            <option value="USA">USA</option>
            <option value="England">England</option>
            <option value="Spain">Spain</option>
            <option value="Italy">Italy</option>
            <option value="France">France</option>
            <option value="Germany">Germany</option>
            <option value="Japan">Japan</option>
            <option value="Brazil">Brazil</option>
            <option value="China">China</option>
            <option value="India">India</option>
            <option value="Russia">Russia</option>
            <option value="SouthAfrica">South Africa</option>
            <option value="Mexico">Mexico</option>
            <option value="Jordan">Jordan</option>
            <option value="Syria">Syria</option>
            <option value="UAE">UAE</option>
            <option value="Qatar">Qatar</option>
            <option value="Egypt">Egypt</option>
            <option value="Palestine">Palestine</option>
        </select> <br><br>


        <select name="phone_code" id="phone_code">
    <option value="+961">Lebanon (+961)</option>
    <option value="+1">USA (+1)</option>
    <option value="+44">United Kingdom (+44)</option>
    <option value="+34">Spain (+34)</option>
    <option value="+39">Italy (+39)</option>
    <option value="+33">France (+33)</option>
    <option value="+49">Germany (+49)</option>
    <option value="+81">Japan (+81)</option>
    <option value="+55">Brazil (+55)</option>
    <option value="+86">China (+86)</option>
    <option value="+91">India (+91)</option>
    <option value="+7">Russia (+7)</option>
    <option value="+27">South Africa (+27)</option>
    <option value="+52">Mexico (+52)</option>
    <option value="+962">Jordan (+962)</option>
    <option value="+963">Syria (+963)</option>
    <option value="+971">UAE (+971)</option>
    <option value="+974">Qatar (+974)</option>
    <option value="+20">Egypt (+20)</option>
    <option value="+970">Palestine (+970)</option>
</select>




<input type="phone" name="phone_number" id="phone_number"> <br>



<select name="gender" id="gender">
    <option value="male">Male</option>
    <option value="female">Female</option>
</select> <br>



<input type="date" id="date_of_birth" name="date_of_birth"> <br><br>



<label for="about">About:</label>
<textarea id="bio" name="bio" rows="4" cols="50"></textarea> <br> 



<label for="profile_pic">Profile Picture:</label>
<input type="file" id="profile_pic" name="profile_pic" enctype="multipart/form-data" >


<button type="submit" id="save" onclick="">Save</button>


</form>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



    <script>
        function updateData(){

            var  form = $("#settingForm").serialize();

            $.ajax({
                    type: "POST",
                    url: "updatingData.php",
                    data: form,
                    success: function(response){
                        alert(response);
                    },
                    error: function(error){
                        alert(error);
                    }   
            })



        }
    </script>


<script>
    //to show the data in each field when the settings page is loaded

    $(document).ready(function() {
        // Function to fetch user profile data
        function fetchUserProfileData() {
            $.ajax({
                type: "POST",
                url: "fetchUserData.php", 
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        console.error("Error fetching profile data:", response.error);
                        return;
                    }
                    // Populate form fields with fetched data
                    $("#firstname").val(response.firstName);
                    $("#lastname").val(response.lastName);
                    $("#email").val(response.email);
                    $("#country").val(response.countryName);
                    $("#phone_code").val(response.phoneCode);
                    $("#phone_number").val(response.phoneNb);
                    $("#gender").val(response.gender);
                    $("#date_of_birth").val(response.dateOfBirth);
                    $("#bio").val(response.bio);
                },
                error: function(error) {
                    console.error("Error fetching profile data:", error);
                }
            });
        }
        fetchUserProfileData();
    });
</script>


</body>
</html>