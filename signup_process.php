<?php
// signup_process.php
session_start();
include('dbconnect.php');
include('userDevice.php');
include('encryption.php');
// $_SESSION['EncryptURL'] = "";
$hashes = ['@&*T$GDYBY','194ybasjb!','CW33rq23$@&','msiam@$*Und','*YCH?D>dsf','32rdm>?CX'];
$EncryptURL = EncryptURLData($hashes);

if(isset($_POST['signupFormSubmit'])){
    if(@isset($_GET['k'])){
        if(@$_GET['k'] == @$_SESSION['EncryptURL']) {
        
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $Date = $_POST['Date'];
            $Month = $_POST['Month'];
            $year = $_POST['year'];
            $gender = $_POST['gender'];
            $board = $_POST['board'];
            $standard = $_POST['standard'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];

            $registration_Date = $currentTime;
            $DOB = $Date . "-" .$Month."-".$year;
            $UserDevice = DeviceCheck();
            $userBrowser =DeviceCheck()." Browser Detected";
            $ipAddress =  Ip_Address();
            $userDeviceName = $Device_name;
            $userSystemInfo = $_SERVER['HTTP_USER_AGENT'];

            $_SESSION['Signup_errors'] = "";

            // Encryption Of Password -
                // MD5
            $md5Pass = md5($password);

                // Salting 
            $SaltingValue1 = "$@dnf69f#(%ds";
            $SaltingValue2 = "{=64^34:{}@Vx";
                // Appending of Saliting 
            $Salted_Plain_Pass = $SaltingValue1.$md5Pass.$SaltingValue2;

                // Encryption of Saliting 
            $HashedSaltedPass = sha1($Salted_Plain_Pass);


            $Final_Encrypted_pass = $HashedSaltedPass.'infi'.$EncryptURL;

            
            if(@ValidateData($name,$email,$phone,$city,$Date,$Month,$year,$gender,$board,$standard,$password,$confirmpassword)){
                if(isset($_SESSION['Registered'])){
                    // echo "Registration Done";
                    $_SESSION['Signup_errors'] = "AlreadyRegisted";
                    echo "<script>window.location.replace('signup.php');</script>";
                }
                else{
                    $found = true;
                    $sql_userCheck = "SELECT * FROM user_login";
                    $result_UserCheck = $conn->query($sql_userCheck);
                    if ($result_UserCheck->num_rows > 0) {
                        while($row = $result_UserCheck->fetch_assoc()) {
                            $userID_string = UserIDGenrtator();
                            $userID_int = (int) $userID_string;
                            if($email == $row['email'] || $userID_int == $row["userid"]){
                                $found = true;
                                break;
                            }else{
                               $found = false;
                            }
                        } 
                        if($found ==  false){
                            $sql = "INSERT INTO user_login(userid,name,email,phone,city,dob,gender,board,standard,password,registration_date,role,device,ip_address,device_details,browser,device_name,status,isblocked,profileimg,isVerfied)
                                        VALUE('$userID_int','$name','$email','$phone','$city','$DOB','$gender',
                                            '$board','$standard','$Final_Encrypted_pass','$registration_Date','Student','$UserDevice','$ipAddress','$userSystemInfo','$userBrowser','$userDeviceName','Active','false','','false')";
                                if ($conn->query($sql) === TRUE) {
                                    if(sendVerificationMail($email, $userID_int, $name)){
                                        $_SESSION['Registered'] = true;
                                        echo "<script>window.location.replace('index.php');</script>";
                                    }else{
                                        $_SESSION['Signup_errors'] = "DatabaseError";
                                        echo "<script>window.location.replace('signup.php');</script>";
                                    }
                                } else {
                                    $_SESSION['Signup_errors'] = "DatabaseError";
                                    echo "<script>window.location.replace('signup.php');</script>";
                                }
                        } if($found ==  true){
                             // echo "User Found";
                            $_SESSION['Signup_errors'] = "UserExists";
                            echo "<script>window.location.replace('signup.php');</script>";
                        }
                    }else{
                        $_SESSION['Signup_errors'] = "DatabaseError";
                        echo "<script>window.location.replace('signup.php');</script>";
                    } 
                }
            }
            else{
                echo "<script>window.location.replace('signup.php');</script>";
            }
        }
        else{
            // echo "Key Not Matched";
            $_SESSION['Signup_errors'] = "SuspeciousActivity";
            echo "<script>window.location.replace('signup.php');</script>";
            // echo '2';
        }
    }
    else{
        // echo "Nothing Got From URL";
        $_SESSION['Signup_errors'] = "SuspeciousActivity";
        echo "<script>window.location.replace('signup.php');</script>";
        // echo '2';
    }
}else{
    header("Location: signup.php");
}




function UserIDGenrtator(){
    $RandomUserID =  mt_rand(1111,9999);
    return $RandomUserID;
}

function sendVerificationMail($user_email, $user_id, $user_name){
    
    $user_email = $user_email;
    $user_id = $user_id;
    $user_name = $user_name;

    require('PHPMailerAutoload.php');
 
    $message = '<div class="email-body" style="width: 100%;height: fit-content;text-align: center;">
    <div class="email-box" style="width: 100%;height: fit-content;border: 3px solid #fe4a55;border-radius: 8px;">
        <div class="email-box-title" style="height: 120px;width: 100%; background-color: #fe4a55;text-align: center;display:flex;justify-content: center;align-items: center;">
            <h1 style="margin: 0px 0px;color: #fff;font-family: sans-serif;font-size: 5vh;">Infilearn</h1>
        </div>
        <div class="email-box-info" style="padding:50px 0;text-align: center;">
            <div class="email-box-info-title">
                <p style="color: #666;font-family: sans-serif;font-size: 5vh;font-weight: 100;">Welcome to Infilearn</p>
            </div>
            <hr style="width: 70%;text-align: center;height: 1.5px;background-color: rgb(185, 185, 185);border: none;">
            <div class="email-box-info-p">
                <p style="color: #221638;font-family: sans-serif;font-size: 4vh;font-weight: 700;">Verify your email-address</p>
            </div>
            <div class="email-box-info-desc">
                <p style="color: #000;font-family: sans-serif;font-size: 3vh;font-weight: 500;">Please click the button below to verify your email address :)</p>
            </div>
            <div class="email-box-verify-btn"> 
                <a href="http://localhost/InfiLearn/verifyEmailWithMail.php?email='.$user_email.'&name='.$user_name.'&key='.$user_id.'">
                    <button style="height:50px;width: 230px;border: none;border-radius: 7px;cursor: pointer;background-color: #fe4a55;color: #fff;font-size: 20px;">Verify Email</button>
                </a>
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
    $mail->From = $_POST["email"];     //Sets the From email address for the message
    $mail->FromName = $_POST["name"];    //Sets the From name of the message
    $mail->AddAddress($user_email, $user_name);  //Adds a "To" address
    $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);       //Sets message type to HTML
    // $mail->AddAttachment($path);     //Adds an attachment from a path on the filesystem
    $mail->Subject = 'Infilearn - Please verify your email address';    //Sets the Subject of the message
    $mail->Body = $message;       //An HTML or plain text message body
    if($mail->Send()){        //Send an Email. Return true on success or false on error
        return true;
    }
    else{
        return false;
    }
}

function ValidateData($name,$email,$phone,$city,$Date,$Month,$year,$gender,$board,$standard,$password,$confirmpassword){

    $name = $name;
    $email = $email;  
    $phone = $phone;    
    $city = $city;  
    $Date = $Date; 
    $Month = $Month;
    $year =  $year;
    $gender = $gender;
    $board =  $board;
    $standard = $standard;
    $password = $password;
    $confirmpassword = $confirmpassword;


    if(!$name == "" || strlen($name) > 3){
        if(!$email == "" ){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // echo "Invalid email format";
                $_SESSION['Signup_errors'] = "InvalidEmail";
                echo "<script>window.location.replace('signup.php');</script>";
                return false;
            }else{
                if(!$phone == "" || strlen($phone) > 10){
                    if(!$city == ""){
                        if(!$Date == ""){
                            if(!$Month == ""){
                                if(!$year == ""){
                                    if(!$gender == ""){
                                        if(!$board == ""){
                                            if(!$standard == ""){
                                                if(!$password == "" || strlen($password) > 8){
                                                    if(!$confirmpassword == "" || strlen($confirmpassword) > 8){
                                                        if($password == $confirmpassword){
                                                            return true;
                                                        }else{
                                                            $_SESSION['Signup_errors'] = "PassNotMatch";
                                                            echo "<script>window.location.replace('signup.php');</script>";
                                                            return false;
                                                        }
                                                    }else{
                                                        // echo "Password must be 8 Character";
                                                        $_SESSION['Signup_errors'] = "Passlesschar";
                                                        echo "<script>window.location.replace('signup.php');</script>";
                                                        return false;
                                                    }
                                                }else{
                                                    // echo "Password must be 8 Character";
                                                    $_SESSION['Signup_errors'] = "Passlesschar";
                                                    echo "<script>window.location.replace('signup.php');</script>";
                                                    return false;
                                                }
                                            }else{
                                                // echo "Invalid Standard";
                                                $_SESSION['Signup_errors'] = "InvalidStandard";
                                                echo "<script>window.location.replace('signup.php');</script>";
                                                return false;
                                            }
                                        }else{
                                            // echo "Invalid Board";
                                            $_SESSION['Signup_errors'] = "InvalidBoard";
                                            echo "<script>window.location.replace('signup.php');</script>";
                                            return false;
                                        }
                                    }else{
                                        // echo "Invalid Gender";
                                        $_SESSION['Signup_errors'] = "InvalidGender";
                                        echo "<script>window.location.replace('signup.php');</script>";
                                        return false;
                                    }
                                }else{
                                    // echo "Invalid Year";
                                    $_SESSION['Signup_errors'] = "InvalidYear";
                                    echo "<script>window.location.replace('signup.php');</script>";
                                    return false;
                                }
                            }else{
                                // echo "Invalid Month";
                                $_SESSION['Signup_errors'] = "InvalidMonth";
                                echo "<script>window.location.replace('signup.php');</script>";
                                return false;
                            }
                        }else{
                            // echo "Invalid Date";
                            $_SESSION['Signup_errors'] = "InvalidDate";
                            echo "<script>window.location.replace('signup.php');</script>";
                            return false;
                        }
                    }else{
                        // echo "Please Enter City";
                        $_SESSION['Signup_errors'] = "InvalidCity";
                        echo "<script>window.location.replace('signup.php');</script>";
                        return false;
                    }
                }else{
                    // echo "Invalid Phone Number";
                    $_SESSION['Signup_errors'] = "InvalidPhone";
                    echo "<script>window.location.replace('signup.php');</script>";
                    return false;
                }
            }
        }else{
            // echo "Email is Empty";
            $_SESSION['Signup_errors'] = "EmptyEmail";
            echo "<script>window.location.replace('signup.php');</script>";
            return false;
        }
    }else{
        // echo "Name Is Invalid";
        $_SESSION['Signup_errors'] = "InvalidName";
        echo "<script>window.location.replace('signup.php');</script>";
        return false;
    }
}

?>