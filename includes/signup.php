<?php
error_reporting(0);
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$mnumber=$_POST['mobilenumber'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql="INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="You are Successfully registered. Now you can login ";
header('location:thankyou.php');
}
else 
{
$_SESSION['msg']="Something went wrong. Please try again.";
header('location:thankyou.php');
}
}
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
            </div>
            <section>
                <div class="modal-body modal-spa">
                    <div class="login-grids">
                        <div class="login">
                            <div class="login-left">
                                <ul>
                                    <li><a class="fb" href="#"><i></i>Facebook</a></li>
                                    <li><a class="goog" href="#"><i></i>Google</a></li>
                                </ul>
                            </div>
                            <div class="login-right">
                                <form name="signup" method="post" onsubmit="return validateForm()">
                                    <h3 style="color: #4679F9;">Create your account </h3>

                                    <input type="text" 
                                           value="" 
                                           placeholder="Full Name" 
                                           name="fname" 
                                           pattern="[A-Za-z ]{3,50}" 
                                           title="Name must be between 3-50 characters, letters only"
                                           class="form-input"
                                           required>

                                    <input type="text" 
                                           value="" 
                                           placeholder="Mobile number" 
                                           name="mobilenumber" 
                                           pattern="[0-9]{10}" 
                                           title="Please enter a valid 10-digit number"
                                           class="form-input"
                                           maxlength="10" 
                                           required>

                                    <input type="email" 
                                           placeholder="Email id" 
                                           name="email" 
                                           id="email" 
                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                           title="Please enter a valid email address"
                                           class="form-input"
                                           autocomplete="new-email"
                                           autocorrect="off"
                                           autocapitalize="off"
                                           spellcheck="false"
                                           onBlur="checkAvailability()" 
                                           required>
                                    <span id="user-availability-status" style="font-size:12px;"></span>

                                    <input type="password" 
                                           value="" 
                                           placeholder="Password" 
                                           name="password" 
                                           id="password"
                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{8,}"
                                           title="Must contain at least 8 characters, including uppercase, lowercase, numbers and special characters"
                                           class="form-input"
                                           required>
                                    <div id="password-strength"></div>

                                    <input type="submit" 
                                           name="submit" 
                                           id="submit" 
                                           value="CREATE ACCOUNT" 
                                           style="background-color: #4679F9; color: white;">
                                </form>
                            </div>
                            <div class="clearfix"></div>								
                        </div>
                        <p>By logging in you agree to our <a href="page.php?type=terms"><span style="color: #4679F9;">Terms and Conditions</span></a> and <a href="page.php?type=privacy"><span style="color: #4679F9;">Privacy Policy</span></a></p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
function validateForm() {
    var fname = document.forms["signup"]["fname"].value;
    var mobile = document.forms["signup"]["mobilenumber"].value;
    var email = document.forms["signup"]["email"].value;
    var password = document.forms["signup"]["password"].value;
    
    // Name validation
    if(!/^[A-Za-z ]{3,50}$/.test(fname)) {
        alert("Please enter a valid name (letters only, 3-50 characters)");
        return false;
    }
    
    // Mobile validation
    if(!/^[0-9]{10}$/.test(mobile)) {
        alert("Please enter a valid 10-digit mobile number");
        return false;
    }
    
    // Email validation
    if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert("Please enter a valid email address");
        return false;
    }
    
    // Password validation
    if(!/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{8,}$/.test(password)) {
        alert("Password must contain at least 8 characters, including uppercase, lowercase, numbers and special characters");
        return false;
    }
    
    return true;
}

// Password strength indicator
document.getElementById('password').addEventListener('input', function() {
    var password = this.value;
    var strength = 0;
    var strengthDiv = document.getElementById('password-strength');
    
    if(password.match(/[a-z]/)) strength++;
    if(password.match(/[A-Z]/)) strength++;
    if(password.match(/[0-9]/)) strength++;
    if(password.match(/[^A-Za-z0-9]/)) strength++;
    if(password.length >= 8) strength++;
    
    var strengthText = '';
    var strengthColor = '';
    
    switch(strength) {
        case 0:
        case 1:
            strengthText = 'Very Weak';
            strengthColor = '#ff0000';
            break;
        case 2:
            strengthText = 'Weak';
            strengthColor = '#ff6600';
            break;
        case 3:
            strengthText = 'Medium';
            strengthColor = '#ffcc00';
            break;
        case 4:
            strengthText = 'Strong';
            strengthColor = '#99cc00';
            break;
        case 5:
            strengthText = 'Very Strong';
            strengthColor = '#009900';
            break;
    }
    
    strengthDiv.innerHTML = '<span style="color: ' + strengthColor + '">' + strengthText + '</span>';
});
</script>

<style>
.form-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #4679F9;
    box-shadow: 0 0 5px rgba(70, 121, 249, 0.2);
}

/* Only show invalid state after user interaction */
.form-input:not(:placeholder-shown):invalid {
    border-color: #ff6666;
}

.form-input:not(:placeholder-shown):valid {
    border-color: #66cc66;
}

#password-strength {
    margin-top: 5px;
    margin-bottom: 15px;
    font-size: 12px;
}

#user-availability-status {
    display: block;
    margin-top: -10px;
    margin-bottom: 15px;
}

input[type="submit"] {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #3567e8 !important;
}
</style>