<?php
session_start();
include('dbconnect.php');
include('encryption.php');

if(isset($_SESSION['otpMatched'])){
    if($_SESSION['otpMatched'] == true){
        if(isset($_SESSION['frgt_user_email'])){

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
                    <div class="verification-page-logo-img-newpass">
                        <!-- Image Here -->
                    </div>
                </div>
                <div id="change-password-input-stuff"  class="verification-page-info-stuff">
                    <div class="verification-page-info-stuff-desc">
                        <h2>Reset your Password?</h2>
                        <!-- <p>Please enter the register email id,<br> Where we can send the link to reset your password</p> -->
                    </div>
                    <div class="verification-page-info-stuff-inputs">
                        <form name="new_password_form" action="newpassword.php" method="POST">
                            <div class="verification-page-info-stuff-input-email">
                                <input type="text" name="new_password" placeholder="New Password" id="new-password-input" required>
                            </div>
                            <div class="verification-page-info-stuff-input-email">
                                <input type="text" name="new_password_confirm" placeholder="Confirm Password" id="confirm-password-input" required>
                            </div>
                            <div class="verification-page-info-stuff-input-submit">
                                <input type="submit" name="password_save_btn" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
                <div id="password-changed-mesg" class="verification-page-info-stuff-send-email-msg">
                    <div class="verification-page-info-stuff-desc">
                        <h2>Congratulations</h2>
                        <p>Your password has been changed</p>
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


if(isset($_POST['password_save_btn'])){
    if(isset($_POST['new_password'])){
        if(isset($_POST['new_password_confirm'])){
        
            $user_pass =  mysqli_escape_string($conn, $_POST['new_password']);
            $user_pass_confirm =  mysqli_escape_string($conn, $_POST['new_password_confirm']);
            $user_email = $_SESSION['frgt_user_email'];

            if($user_pass == $user_pass_confirm){
               
                $hashes = ['@&*T$GDYBY','194ybasjb!','CW33rq23$@&','msiam@$*Und','*YCH?D>dsf','32rdm>?CX'];
                $EncryptURL = EncryptURLData($hashes);

                // Hashing Plain Pass 
                $md5Pass = md5($user_pass);
                // Salting 
                $SaltingValue1 = "$@dnf69f#(%ds";
                $SaltingValue2 = "{=64^34:{}@Vx";
                // Appending of Saliting 
                $Salted_Plain_Pass = $SaltingValue1.$md5Pass.$SaltingValue2;
                // Encryption of Saliting 
                $HashedSaltedPass = sha1($Salted_Plain_Pass);
                $Final_Encrypted_pass = $HashedSaltedPass.'infi'.$EncryptURL;

                $sql_update = "UPDATE user_login SET password = '$Final_Encrypted_pass' WHERE email = '$user_email'";
                if($conn->query($sql_update)=== TRUE){
                    if (SendMail($user_email) == true) {
                        echo '<script>SuccesfullPassChanged()</script>';
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
                            <p>Error occured, Please Try again Later :(</p>
                        </div>';
                    echo '<script>window.history.replaceState( null, null, window.location.href );</script>';
                }

            }else{
                echo '
                    <div class="client-error-mesg">
                        <p>Password did&apos;t Matched!</p>
                    </div>';
                echo '<script>window.history.replaceState( null, null, window.location.href );</script>';
            }
            
        }else{
            echo '
                <div class="client-error-mesg">
                    <p>Please Confirm Password!</p>
                </div>';
            echo '<script>window.history.replaceState( null, null, window.location.href );</script>';
        }
    }else{
        echo '
            <div class="client-error-mesg">
                <p>Please Enter Password!</p>
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
}else{
echo "<script>window.location.replace('forgetpassword.php');</script>";    
}

function SendMail($email){
    $email = $email;

    require('PHPMailerAutoload.php');
 
    $message = '<div class="email-body" style="width: 98%;height: fit-content;text-align: center;">
    <div class="email-box" style="width: 100%;height: fit-content;border: 3px solid #fe4a55;border-radius: 8px;">
        <div class="email-box-title" style="height: 120px;width: 100%; background-color: #fe4a55;text-align: center;display:flex;justify-content: center;align-items: center;">
            <h1 style="margin: auto;color: #fff;font-family: sans-serif;font-size: 5vh;text-align: center;">Infilearn</h1>
        </div>
        <div class="email-box-info" style="padding:50px 0;text-align: center;">
            <div class="email-box-info-title">
                <p style="color: #666;font-family: sans-serif;font-size: 5vh;font-weight: 100;">Your Password has been changed</p>
            </div>
            <hr style="width: 70%;text-align: center;height: 1.5px;background-color: rgb(185, 185, 185);border: none;">
            <div class="email-box-info-p">
                <p style="color: #221638;font-family: sans-serif;font-size: 4vh;font-weight: 700;">Information about password change</p>
            </div>
            <div class="email-box-info-desc">
                <p style="color: #000;font-family: sans-serif;font-size: 3vh;font-weight: 500;">Ignore this mail if you have change the password,<br>Otherwise contact us through contact us section and let us know</p>
            </div>
            <div class="email-box-info-desc">
                <p style="color: #000;font-family: sans-serif;font-size: 3vh;font-weight: 500;">Thank You:)</p>
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
    $mail->AddAddress($email, $email);  //Adds a "To" address
    $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);       //Sets message type to HTML
    // $mail->AddAttachment($path);     //Adds an attachment from a path on the filesystem
    $mail->Subject = 'Infilearn - Your Password has been changed';    //Sets the Subject of the message
    $mail->Body = $message;       //An HTML or plain text message body
    if($mail->Send()){        //Send an Email. Return true on success or false on error
        return true;
    }
    else{
        return false;
    }
}

?>