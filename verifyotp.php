<?php
include('dbconnect.php');
session_start();
if(isset($_SESSION['frgt_user_email'])){
    if(isset($_SESSION['time_limit'])){
        
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#221638">
    <title>Home | Infilearn</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/errors.css">
    <link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">



</head>
<body>
    <section class="verification-pages-section">
        <div class="verification-page-section-div">
            <div class="verification-page-box">
                <div class="verification-page-logo">
                    <div class="verification-page-logo-img">
                        <!-- Image Here -->
                    </div>
                </div>
                <div id="verification-page-info-verify-otps"  class="verification-page-info-stuff">
                    <div class="verification-page-info-stuff-desc">
                        <h2>Email Verification</h2>
                        <p>Please enter the OTP sent on your registered email id,<br>
                            <br><br> <mark>If you didn't found our mail please check spam folder Thank you :)</mark>
                        </p>
                    </div>
                    <div class="verification-page-info-stuff-inputs">
                        <form name="email_verification_form" action="verifyotp.php" method="POST">
                            <div class="verification-page-info-stuff-input-email">
                                <input id="otp_number_input" type="number" name="verify_otp" placeholder="Enter OTP" id="forgot-email-input" maxlength="6" minlength="6" required>
                            </div>
                            <div class="verification-page-info-stuff-input-resend-code">
                                <a href="forgetpassword.php">Resend Code</a>
                            </div>
                            <div class="verification-page-info-stuff-input-submit">
                                <input id="Proceed-btn" type="submit" value="Proceed" name="codeSubmit_btn">
                            </div>
                        </form>
                    </div>
                </div>
                <div id="verification-page-send-email-msgs" class="verification-page-info-stuff-send-email-msg">
                    <div class="verification-page-info-stuff-desc">
                        <h2>Opt Matched </h2>
                        <p>Now you can change your password :)</p>
                        <p id="verf-redirect-msg">Wait... we will redirect you in a moment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js' ></script>
    <script src="js/script.js"></script>


</body>
</html>
<?php 
if(isset($_POST['codeSubmit_btn'])){
    if(isset($_POST['verify_otp'])){
        if($_SESSION['time_limit'] > 1){
        $user_otp =  mysqli_escape_string($conn, $_POST['verify_otp']);
        $user_email = $_SESSION['frgt_user_email'];

        
        $found = false;

        $sql = "SELECT * FROM reset_otp";
        $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $db_email = $row['email'];
                    $db_otp = $row['code'];
                    if($user_email ==  $db_email && $user_otp == $db_otp){
                        $found = true;
                        break;
                    }else{
                        $found = false;

                    }
                }
                if($found == true){
                    $_SESSION['otpMatched'] = true;
                    echo '<script>VerifyOtpRedirect()</script>';
                }
                if($found == false){
                    $_SESSION['otpMatched'] = false;
                    $_SESSION['time_limit'] = $_SESSION['time_limit'] - 1;
                    echo '
                        <div class="client-error-mesg">
                            <p>OTP did&apos;t Matched :( <br>
                                You have '.$_SESSION['time_limit'].' Chance Left!
                            </p>
                        </div>';
                    echo '<script>window.history.replaceState( null, null, window.location.href );</script>';

                }
            }else{
                echo '
                    <div class="client-error-mesg">
                        <p>Error occured, Please Try again Later :(</p>
                    </div>';
                echo '<script>window.history.replaceState( null, null, window.location.href );</script>';

            }
            }else{
                echo '
                    <div class="client-error-mesg">
                        <p>You have done it maximum time, Please Try again Later!</p>
                    </div>';
                    echo '<script>DisableFunctionOTP()</script>';

                    echo '<script>window.history.replaceState( null, null, window.location.href );</script>';
            }
        
        }else{
            echo '
                <div class="client-error-mesg">
                    <p>Please Enter the OTP!</p>
                </div>';
            echo '<script>window.history.replaceState( null, null, window.location.href );</script>';

        }
    }
}else{
    echo "<script>window.location.replace('forgetpassword.php');</script>";
}
}else{
    echo "<script>window.location.replace('forgetpassword.php');</script>";
}
?>