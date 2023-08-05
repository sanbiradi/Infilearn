<?php
session_start();
include('dbconnect.php');
include('encryption.php');
include('userDevice.php');
if(isset($_POST['loginSubmit'])){
    $hashes = ['@&*T$GDYBY','194ybasjb!','CW33rq23$@&','msiam@$*Und','*YCH?D>dsf','32rdm>?CX'];
    $EncryptURL = EncryptURLData($hashes);

    $time = $currentTime;
    $userEmail = $_POST['email'];
    $password = $_POST['password'];
    $HashedPass = md5($password);
    // Hashing Plain Pass 
    $md5Pass = md5($password);
    // Salting 
    $SaltingValue1 = "$@dnf69f#(%ds";
    $SaltingValue2 = "{=64^34:{}@Vx";
    // Appending of Saliting 
    $Salted_Plain_Pass = $SaltingValue1.$md5Pass.$SaltingValue2;
    // Encryption of Saliting 
    $HashedSaltedPass = sha1($Salted_Plain_Pass);
    $Final_Encrypted_pass = $HashedSaltedPass.'infi'.$EncryptURL;

    $UserDevice = DeviceCheck();
    $userBrowser =DeviceCheck()."Browser Detected";
    $ipAddress =  Ip_Address();
    $userDeviceName = $Device_name;
    $userSystemInfo = $_SERVER['HTTP_USER_AGENT'];


    $EncryptionKey="$^7f%b@51J&Bygb+";
    $encrypted_CookieEmail=openssl_encrypt($userEmail,"AES-128-ECB",$EncryptionKey);
    $encrypted_CookiePass=openssl_encrypt($password,"AES-128-ECB",$EncryptionKey);
    // echo $encrypted_CookiePass;

    $decrypted_CookiePass=openssl_decrypt($encrypted_CookiePass,"AES-128-ECB",$EncryptionKey);
    // echo "<br>".$decrypted_CookiePass;



    $isLoggedIn = false;
    $sql = "SELECT * FROM user_login";
    $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $db_Email = $row['email'];
                $db_pass = $row['password'];
                $userId = $row['userid'];
                $role = $row['role'];
                $isVerfied = $row['isVerfied'];
                $isBlocked = $row['isblocked'];
                // echo $db_Email."<br>";
                
                if($userEmail == $db_Email && $Final_Encrypted_pass == $db_pass){
                    $isLoggedIn = true;
                    break;
                }
                else{
                    $isLoggedIn = false;
                }
            }
            if($isLoggedIn == true){
                $Login_logs_sql =  "INSERT INTO login_logs(userid,email,role,time,device,ip_address,device_details,browser,device_name)
                                    VALUES('$userId','$db_Email','$role','$time','$UserDevice','$ipAddress','$userSystemInfo','$userBrowser','$Device_name')";
                if ($conn->query($Login_logs_sql) === TRUE) {
                    if($isBlocked == "false"){
                        if ($isVerfied == "true") {
                            if (isset($_POST['rememberme'])) {
                                setcookie("email", $encrypted_CookieEmail, time() + 2628000);
                                setcookie("key", $encrypted_CookiePass, time() + 2628000);
                            }

                            $_SESSION['loggedin'] = true;
                            $_SESSION['userid'] = $userId;
                            if ($role == "Student") {
                                echo "<script>window.location.replace('selectSubject.php');</script>";
                            }
                            if ($role == "Teacher") {
                                echo "<script>window.location.replace('teacherSubjectSelection.php');</script>";
                            }
                            if ($role == "Admin") {
                                echo "<script>window.location.replace('adminPanel.php');</script>";
                            }
                        }else{
                            $_SESSION['userid'] = $userId;
                            echo "<script>window.location.replace('emailVerification.php');</script>";
                        }

                    }else{
                        $_SESSION['loginErrors'] = "blocked";
                        echo "<script>window.location.replace('index.php');</script>";
                    }
                }else{
                    $_SESSION['loginErrors'] = "erroroccured";
                    echo "<script>window.location.replace('index.php');</script>";
                }
            }if($isLoggedIn == false){
                $_SESSION['loginErrors'] = "loginfailed";
                echo "<script>window.location.replace('index.php');</script>";
            }
        }else{
            $_SESSION['loginErrors'] = "noValueReturn";
            echo "<script>window.location.replace('index.php');</script>";
        }
}else{
    $_SESSION['loginErrors'] = "supecious";
    header('Location: index.php'); 
}

?>
