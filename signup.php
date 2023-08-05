<?php session_start(); 
include('dbconnect.php');
if(isset($_COOKIE['email']) && $_COOKIE['key']){
    header("Location: autoLogin.php");
}
include('encryption.php');
$_SESSION['EncryptURL'] = "";
$hashes = ['@&*T$GDYBY','194ybasjb!','CW33rq23$@&','msiam@$*Und','*YCH?D>dsf','32rdm>?CX'];
$EncryptURL = EncryptURLData($hashes);
$_SESSION['EncryptURL'] = $EncryptURL;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="keywords" content="Infilearn,free,e-learning,learning,platform,free learning">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="robots" content="index" />

    <meta name="googlebot" content="index">
    <meta name="googlebot-news" content="snippet">
    <!-- Generated -->
    <!-- Primary Meta Tags -->
    <title>Signup | InfiLearn - India's free E-learning platform</title>
    <meta name="title" content="InfiLearn - India's free E-learning platform">
    <meta name="description" content="Infilearn provides a free learning platform for all students. A free E-Learning Platform for students">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://infilearn.000webhostapp.com/">
    <meta property="og:title" content="InfiLearn - India's free E-learning platform">
    <meta property="og:description" content="Infilearn provides a free learning platform for all students. A free E-Learning Platform for students">
    <meta property="og:image" content="https://infilearn.000webhostapp.com/content/icons/new.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://infilearn.000webhostapp.com/">
    <meta property="twitter:title" content="InfiLearn - India's free E-learning platform">
    <meta property="twitter:description" content="Infilearn provides a free learning platform for all students. A free E-Learning Platform for students">
    <meta property="twitter:image" content="https://infilearn.000webhostapp.com/content/icons/new.png">

    <meta name="theme-color" content="#fe4a55">
    <link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="css/style.css">
    <link id="validationCss" rel="stylesheet" href="css/validation.css" d>
    <link id="LoginCss" rel="stylesheet" href="css/login_validation.css">
   
</head>
<body>
    <?php include('header.php'); ?>


    <!-- Signup Section -->
    <section class="signup-section">
        <div class="signup-div">
            <div class="signup-div-box">
                <div class="signup-box-branding">
                    <div class="signup-box-branding-title">
                        <h2>InfiLearn</h2>
                    </div>
                    <div class="signup-box-branding-welcome">
                        <h3>Welcome!</h3>
                        <h2>Create Your Account</h2>
                    </div>
                    <div class="signup-box-phone-img"></div> <!-- Image Mobile-->
                </div>
                <div class="signup-box-inputs">
                    <div class="signup-box-input-title">
                        <h3>Registration</h3>
                    </div>
                    <div id="signupbox" class="signup-box-all-inputs">
                        <form id="SignUp-Form" action="signup_process.php?k=<?php echo $EncryptURL; ?>" method="post">
                            <div class="signup-box-input-boxs name-email">
                                <div class="signupbox-name">
                                    <label for="student-name">FULL NAME</label> <br>
                                    <input id="student-name" name="name" type="text" class="signup-input" required>
                                </div>
                                <div class="signupbox-email">
                                    <label for="student-email">EMAIL ADDRESS</label> <br>
                                    <input id="student-email" name="email" type="email" class="signup-input" required>
                                </div> 
                            </div>
                            <div class="signup-box-input-boxs mobile-city">
                                <div class="signupbox-mobile">
                                    <label for="student-mobile">MOBILE NUMBER</label> <br>
                                    <input id="student-mobile" name="phone" type="number" class="signup-input" min="10" required >
                                </div>
                                <div class="signupbox-city">
                                    <label for="student-city">CITY</label> <br>
                                    <input id="student-city" name="city" type="text" class="signup-input" required>
                                </div>
                            </div>
                            <div class="signup-box-input-boxs dob-gender">
                                <div class="signupbox-dob">
                                    <label id="dob-label-signupbox" for="dob-date">DATE OF BIRTH</label> <br>
                                    <select class="signup-inputs" name="Date" id="dob-date" required>
                                        <option selected disabled>DD</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                    <select class="signup-inputs" name="Month" id="dob-month" required>
                                        <option selected disabled>MM</option>
                                        <option value="jan">Jan</option>
                                        <option value="feb">Feb</option>
                                        <option value="mar">Mar</option>
                                        <option value="apr">Apr</option>
                                        <option value="may">May</option>
                                        <option value="june">June</option>
                                        <option value="july">July</option>
                                        <option value="aug">Aug</option>
                                        <option value="sep">Sep</option>
                                        <option value="oct">Oct</option>
                                        <option value="nov">Nov</option>
                                        <option value="dec">Dec</option>
                                    </select>
                                    <select class="signup-inputs" name="year" id="dob-year" required>
                                        <option selected disabled>YYYY</option>
                                        <option value="1950">1950</option>
                                        <option value="1951">1951</option>
                                        <option value="1952">1952</option>
                                        <option value="1953">1953</option>
                                        <option value="1954">1954</option>
                                        <option value="1955">1955</option>
                                        <option value="1956">1956</option>
                                        <option value="1957">1957</option>
                                        <option value="1958">1958</option>
                                        <option value="1959">1959</option>
                                        <option value="1960">1960</option>
                                        <option value="1961">1961</option>
                                        <option value="1962">1962</option>
                                        <option value="1963">1963</option>
                                        <option value="1964">1964</option>
                                        <option value="1965">1965</option>
                                        <option value="1966">1966</option>
                                        <option value="1967">1967</option>
                                        <option value="1968">1968</option>
                                        <option value="1969">1969</option>
                                        <option value="1970">1970</option>
                                        <option value="1971">1971</option>
                                        <option value="1972">1972</option>
                                        <option value="1973">1973</option>
                                        <option value="1974">1974</option>
                                        <option value="1975">1975</option>
                                        <option value="1976">1976</option>
                                        <option value="1977">1977</option>
                                        <option value="1978">1978</option>
                                        <option value="1979">1979</option>
                                        <option value="1970">1970</option>
                                        <option value="1971">1971</option>
                                        <option value="1972">1972</option>
                                        <option value="1973">1973</option>
                                        <option value="1974">1974</option>
                                        <option value="1975">1975</option>
                                        <option value="1976">1976</option>
                                        <option value="1977">1977</option>
                                        <option value="1978">1978</option>
                                        <option value="1979">1979</option>
                                        <option value="1980">1980</option>
                                        <option value="1981">1981</option>
                                        <option value="1982">1982</option>
                                        <option value="1983">1983</option>
                                        <option value="1984">1984</option>
                                        <option value="1985">1985</option>
                                        <option value="1986">1986</option>
                                        <option value="1987">1987</option>
                                        <option value="1988">1988</option>
                                        <option value="1989">1989</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1997">1997</option>
                                        <option value="1998">1998</option>
                                        <option value="1999">1999</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                                
                                <div class="signupbox-gender">
                                    <label id="gender-label-signupbox" for="gender">GENDER</label> <br>
                                    <input type="radio" class="signup-inputs" name="gender" value="male"><span>MALE</span> </input>
                                    <input type="radio" class="signup-inputs" name="gender" value="female"><span>FEMALE</span> </input>
                                    <input type="radio" class="signup-inputs" name="gender" value="other"><span>OTHER</span> </input>
                                </div>
                            </div>
                            <div class="signup-box-input-boxs board-standard">
                                <div class="signupbox-board">
                                    <label for="student-board">BOARD</label> <br>
                                    <select class="signup-input" name="board" id="student-board" required>
                                        <option selected disabled>Select Board</option>
                                        <option value="SSC">SSC</option>
                                    </select>
                                </div>
                                <div class="signupbox-standard">
                                    <label for="student-standard">STANDARD</label> <br>
                                    <select class="signup-input" name="standard" id="student-standard" required>
                                        <option selected disabled>Select Standard</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="signup-box-input-boxs pass-confirm-pass">
                                <div class="signupbox-pass">
                                    <label for="student-password">PASSWORD</label> <br>
                                    <input id="student-password" name="password" type="password" class="signup-input" minlength="8" required>
                                </div>
                                <div class="signupbox-confirm-pass">
                                    <label for="student-comfirm-password">CONFIRM PASSWORD</label> <br>
                                    <input id="student-comfirm-password" name="confirmpassword" type="password" class="signup-input" minlength="8" required>
                                </div>
                            </div>
                            <div class="signup-form-submit-button">
                                <input name="signupFormSubmit" type="submit" value="Sign up" class="signup-form-submit-btn">
                            </div>
                        </form>    
                    </div>
                    <div class="login-modal-link">
                        <p>Already have an account? <a onclick="ModalShow();">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>


    <?php include('loginmodal.php') ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js" ></script>
  <script src="js/validateForm.js" defer></script>
  <script src="js/hamburger.js" defer></script>
  <script src="js/script.js" defer></script>
</body>
</html>

<?php

if(isset($_SESSION['Signup_errors'])){
    if($_SESSION['Signup_errors'] == "DatabaseError"){
        echo '
            <div class="client-error-mesg">
                <p>User Not Created, Please Try Again After some time..</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "AlreadyRegisted"){
        echo '
            <div class="client-error-mesg">
                <p>User Already Registered</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "UserExists"){
        echo '
            <div class="client-error-mesg">
                <p>User Already Exists</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "FormError"){
        echo '
            <div class="client-error-mesg">
                <p>Please fill the Form Correct!!</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "SuspeciousActivity"){
        echo '
            <div class="client-error-mesg">
                <p>Suspecious Activity is being detected</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "InvalidEmail"){
        echo '
            <div class="client-error-mesg">
                <p>Please Enter Email in Correct format!!</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "PassNotMatch"){
        echo '
            <div class="client-error-mesg">
                <p>Password Does Not Match</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "Passlesschar"){
        echo '
            <div class="client-error-mesg">
                <p>Password should not be less the 8 Character</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "InvalidStandard"){
        echo '
            <div class="client-error-mesg">
                <p>Please Select your Standard</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "InvalidBoard"){
        echo '
            <div class="client-error-mesg">
                <p>Please Select Your Board</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "InvalidGender"){
        echo '
            <div class="client-error-mesg">
                <p>Please Select your Gender</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "InvalidYear"){
        echo '
            <div class="client-error-mesg">
                <p>Please Select your Birth Year</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "InvalidMonth"){
        echo '
            <div class="client-error-mesg">
                <p>Please Select your Birth Month</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "InvalidDate"){
        echo '
            <div class="client-error-mesg">
                <p>Please Select your Birth Date</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "InvalidCity"){
        echo '
            <div class="client-error-mesg">
                <p>Please Enter your City</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "InvalidPhone"){
        echo '
            <div class="client-error-mesg">
                <p>Please Enter your Phone</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "EmptyEmail"){
        echo '
            <div class="client-error-mesg">
                <p>Please Enter your Email</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }

    if($_SESSION['Signup_errors'] == "InvalidName"){
        echo '
            <div class="client-error-mesg">
                <p>Please Enter your Name</p>
            </div>';
            $_SESSION['Signup_errors'] = "";
    }
    $_SESSION['Signup_errors'] = "";
}

?>