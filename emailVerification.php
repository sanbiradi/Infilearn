<?php
session_start();
include('dbconnect.php');
if(isset($_SESSION['userid'])){

        $userId = $_SESSION['userid'] ;
        $getInfo = false;
        
        $sql = "SELECT * FROM user_login";
        $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $dbUserId = $row['userid'];
                    $dbUsername = $row['name'];
                    $dbBoard = $row['board'];
                    $dbClass = $row['standard'];
                    $dbRole = $row['role'];
                    $dbProfileimg = $row['profileimg'];
                    $dbisVerfied = $row['isVerfied'];
                    if($userId ==  $dbUserId){
                        $getInfo = true;
                        break;
                    }else{
                        $getInfo = false;
                    }
                }
                if($getInfo == true){
                    $username = $dbUsername;
                    $board = $dbBoard;
                    $class = $dbClass;
                    $role =  $dbRole;
                    $profileImg = $dbProfileimg;
                    $isVerfied =  $dbisVerfied;

                    $_SESSION['username'] = $username;
                    $_SESSION['board'] = $board;
                    $_SESSION['class'] = $class;
                    $_SESSION['profileImg'] = $profileImg;

                    if($isVerfied == 'true'){
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
                    }


                }if($getInfo == false){
                    $_SESSION['loginErrors'] = "noValueReturn";
                    echo "<script>window.location.replace('index.php');</script>";
                }
            }
            

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fe4a55">
    <title>Home | Infilearn</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/errors.css">
    <link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">

    
</head>
<body>
    <header>
        <div class="select-subject-desktop-header">
            <div class="select-subject-desktop-logo">
                <a href="index.php">
                    <img class="infilearn-logo" src="content/icons/new.png" alt="Infilearn Logo" height="60px">
                </a>
            </div>
            <div class="select-subject-dashboard-header-profile">
                <div class="select-subject-dashboard-header-profile-box">
                    <p><?php echo @$username;?></p>
                    <div class="select-subject-dashboard-profile-dp" onclick="showDrpDwn();">
                    <?php 
                        if(!$profileImg == ""){
                            ?>
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($profileImg); ?>" alt="user profile" height="35px" width="35px">
                            <?php
                        }else{
                            ?>
                                <img src="content/default/defaultprofile.png" alt="user profile" height="35px" width="35px">
                            <?php
                        }
                    ?>
                    </div> <!--Dashboard user Profile Photo-->
                </div>
                <div id="subject-dashboard-profile-drowdown" class="subject-dashboard-profile-drowdown">
                    <a href="profile.php">Profile</a>
                    <hr class="dropdwon-profile-hr">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Section Select subject -->

    <section class="select-subject-section" style="height: 80vh;padding:10px">
        <div class="select-subject-div">
            <div class="select-subject-div-title">
                <h2>Please Verify your email address to proceed further ;)</h2>
            </div>
        </div>
    </section>

    
    <!-- Become an Instructor Section 5-->
    
    
    <script src="js/script.js" defer></script>

</body>
</html>

<?php

   
}else{
    $_SESSION['loginErrors'] = "supecious";
    // header('Location: index.php'); 
}

?>