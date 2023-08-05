<?php
include('dbconnect.php');
session_start();
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
                <div id="verification-page-info-stuffs"  class="verification-page-info-stuff">
                    <div class="verification-page-info-stuff-desc">
                        <h2>Forgot your Password?</h2>
                        <p>Please enter the register email id,<br> Where we can send the link to reset your password</p>
                    </div>
                    <div class="verification-page-info-stuff-inputs">
                        <form name="forgot_email_form" action="forgetpassword.php" method="POST">
                            <div class="verification-page-info-stuff-input-email">
                                <input type="email" name="forgot_email" placeholder="Email" id="forgot-email-input" required>
                            </div>
                            <div class="verification-page-info-stuff-input-submit">
                                <input type="submit" name="passSubmit_btn" value="Send Verification Code">
                            </div>
                        </form>
                    </div>
                </div>
                <div id="verification-page-verify-otp-mesg" class="verification-page-info-stuff-send-email-msg">
                    <div class="verification-page-info-stuff-desc">
                        <h2>Please check your email</h2>
                        <p>We've just sent you email<br> with the instruction to reset your password</p>
                        <p id="verf-redirect-msg">Wait... we will redirect you in a moment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/script.js"></script>

</body>
</html>
<?php 
if(isset($_POST['passSubmit_btn'])){
    if(isset($_POST['forgot_email'])){
        $user_email =  mysqli_escape_string($conn, $_POST['forgot_email']);

        $found = false;

        $sql = "SELECT * FROM user_login";
        $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $db_email = $row['email'];
                    if($user_email ==  $db_email){
                        $found = true;
                        break;
                    }else{
                        $found = false;
                    }
                }

                if($found == true){
                    $existed = false;
                    $sql_s = "SELECT * FROM reset_otp WHERE email = '$user_email'";
                    $result = $conn->query($sql_s);
                    if ($result->num_rows > 0 || $result->num_rows == 0) {
                        while ($row = $result->fetch_assoc()) {
                            $db_otp_email = $row['email'];
                            if ($user_email == $db_otp_email) {
                                $existed = true;
                                break;

                            } else {
                                $existed = false;
                            }
                        }
                        if ($existed == true) {
                            $verification_code = mt_rand(111111, 999999);

                            $sql_insert = "UPDATE reset_otp SET code = '$verification_code' WHERE email = '$user_email' ";
                            if ($conn->query($sql_insert) === TRUE) {
                                if (SendOtp($user_email, $verification_code) == true) {
                                    echo '<script>showEmailSendDiv()</script>';
                                    $_SESSION['frgt_user_email'] = $user_email;
                                    $_SESSION['time_limit'] = 5;
                                }else{
                                    echo '
                                    <div class="client-error-mesg">
                                        <p>Sorry for inconvnience, Please Try Again Later :(</p>
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
                        }
                        if($existed == false){
                            $verification_code = mt_rand(111111, 999999);

                            $sql_insert = "INSERT into reset_otp(code, email) VALUES('$verification_code','$user_email')";
                            if ($conn->query($sql_insert) === TRUE) {
                                if (SendOtp($user_email, $verification_code) == true) {
                                    echo '<script>showEmailSendDiv()</script>';
                                    $_SESSION['frgt_user_email'] = $user_email;
                                    $_SESSION['time_limit'] = 5;
                                }else{
                                    echo '
                                    <div class="client-error-mesg">
                                        <p>Sorry for inconvnience, Please Try Again Later :(</p>
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
                        }
                    }
                }
                if($found == false){
                    echo '
                        <div class="client-error-mesg">
                            <p>Email Not Registered, Please Enter registered email</p>
                        </div>';
                    
                    echo '<script>window.history.replaceState( null, null, window.location.href );</script>';
                }
            }
        
    }
}

function SendOtp($user_email , $otp){
    $user_email = $user_email;
    $otp = $otp;

    require('PHPMailerAutoload.php');
 
    $message = '<div class="email-body" style="width: 98%;height: fit-content;text-align: center;">
    <div class="email-box" style="width: 100%;height: fit-content;border: 3px solid #fe4a55;border-radius: 8px;">
        <div class="email-box-title" style="height: 120px;width: 100%; background-color: #fe4a55;text-align: center;display:flex;justify-content: center;align-items: center;">
            <h1 style="margin: auto;color: #fff;font-family: sans-serif;font-size: 5vh;text-align: center;">Infilearn</h1>
        </div>
        <div class="email-box-info" style="padding:50px 0;text-align: center;">
            <div class="email-box-info-title">
                <p style="color: #666;font-family: sans-serif;font-size: 5vh;font-weight: 100;">Welcome to Infilearn</p>
            </div>
            <hr style="width: 70%;text-align: center;height: 1.5px;background-color: rgb(185, 185, 185);border: none;">
            <div class="email-box-info-p">
                <p style="color: #221638;font-family: sans-serif;font-size: 4vh;font-weight: 700;">Reset your Password</p>
            </div>
            <div class="email-box-info-desc">
                <p style="color: #000;font-family: sans-serif;font-size: 3vh;font-weight: 500;">Please Enter the below otp to change your password :)</p>
            </div>
            <div class="email-box-verify-code">
                <p style="color: #fe4a55;font-size: 5vh;font-weight: 900;font-family: sans-serif;letter-spacing: 3px;">'.$otp.'</p>
            </div>
        </div>
    </div>
</div>';


    $mail = new PHPMailer;
    $mail->IsSMTP();        //Sets Mailer to send message using SMTP
    $mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->Port = 587;
    $mail->SMTPDebug = 0;        //Sets the default SMTP server port
    $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username = 'help.infilearn@gmail.com';     //Sets SMTP username
    $mail->Password = 'StudLonde';     //Sets SMTP password
    $mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
    $mail->From = 'help.infilearn@gmail.com';     //Sets the From email address for the message
    $mail->FromName = 'Infilearn';    //Sets the From name of the message
    $mail->AddAddress($user_email, $user_email);  //Adds a "To" address
    $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);       //Sets message type to HTML
    // $mail->AddAttachment($path);     //Adds an attachment from a path on the filesystem
    $mail->Subject = 'Infilearn - OTP to Reset your password';    //Sets the Subject of the message
    $mail->Body = $message;       //An HTML or plain text message body
    if($mail->Send()){        //Send an Email. Return true on success or false on error
        return true;
    }
    else{
        return false;
    }
}
?>