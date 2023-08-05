<?php
session_start();
include('dbconnect.php');
if(isset($_SESSION['loggedin'])){
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

                    $_SESSION['username'] = $username;
                    $_SESSION['board'] = $board;
                    $_SESSION['class'] = $class;
                    $_SESSION['profileImg'] = $profileImg;

                    if($role != "Student"){
                        if($role == "Teacher"){
                            echo "<script>window.location.replace('teacherSubjectSelection.php');</script>";
                        }
                        if($role == "Admin"){
                            echo "<script>window.location.replace('adminPanel.php');</script>";
                        }else{
                            $_SESSION['loginErrors'] = "noValueReturn";
                            echo "<script>window.location.replace('index.php');</script>";
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
    <title>Student Dashboard | Infilearn</title>
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

    <section class="select-subject-section">
        <div class="select-subject-div">
            <div class="select-subject-div-title">
                <h2>Select a subject</h2>
            </div>
            <div class="select-subject-div-all-subjects">

            <?php
                $sql = "SELECT * FROM subjects WHERE board='$board' AND standard='$class'";
                $result = $conn->query($sql);
                if(@$result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $subDb_subject = $row['subjectname'];
                        $subDb_Url = $row['imagepath'];
                        $subjet_arr[] =  $row['subjectname'];
 
                        ?>
                        <div class="select-subject-single-sub" onclick="window.location.assign('dashboard.php?s=<?php echo $subDb_subject; ?>&c=');">
                            <div class="select-subject-img"> 
                                <img src="<?php echo $subDb_Url;?>" alt="subject image" height="120px">
                            </div>
                            <div class="selec-subject-div-subject-name">
                                <h3><?php echo $subDb_subject; ?></h3>
                            </div>
                        </div>
                        <?php
                    }
                    $_SESSION['subject_arr'] =  $subjet_arr;
                }else{
                    $_SESSION['usererrors'] = "errorOccuredSubject";
                    echo '<p class="no-subject-mesg-db">
                                <h3 class="no-subject-mesg-h3">No Subject Found</h3>
                            </p>';
                }
            ?>
            </div>
        </div>
    </section>

    
    <!-- Become an Instructor Section 5-->
    
    <section class="become-instructor-section">
        <div class="become-instructor-div">
            <div class="become-instructor-info">
                <h2 class="become-instructor-info-title">Become an instructor</h2>
                <p class="become-instructor-info-desc">InfiLearn comes with great feature, where anyone can teach for free</p>
                <button class="become-instructor-info-button" onclick="window.location.assign('becomeInstructor.php');">Start teaching today</button>
                <p class="become-instructor-info-video-info">Check out <a onclick="ModalShowBecomeInstructor();">How you can?</a></p>
                
                <!-- <div class="become-instructor-pattern"></div>  Pattern -->
            </div>

            <div class="become-instructor-image"></div>
        </div>
    </section>
    <?php include('howcanyou.php'); ?>
    <script src="js/script.js"></script>

</body>
</html>

<?php
if(isset($_SESSION['usererrors'])){
    if(!$_SESSION['usererrors'] == ""){
        if($_SESSION['usererrors'] == "errorOccured"){
            echo '
            <div class="client-error-mesg">
                <p>An Error Occured, Please Try Again</p>
            </div>';
            $_SESSION['usererrors'] = "";
        }

        if($_SESSION['usererrors'] == "errorOccuredSubject"){
            echo '
            <div class="client-error-mesg">
                <p>An Error Occured, in finding subjects<br>Please Try Again</p>
            </div>';
            $_SESSION['usererrors'] = "";
        }


        if($_SESSION['usererrors'] == "illeggal"){
            echo '
            <div class="client-error-mesg">
                <p>Don&apos;t be Smart Mr '.$username.' <br> Keep Focus on Learning!<br>Thank You ;)</p>
            </div>';
            $_SESSION['usererrors'] = "";
        }


        $_SESSION['usererrors'] = "";
    }
    $_SESSION['usererrors'] = "";
}

    }else{
        $_SESSION['loginErrors'] = "nouserfound";
        echo "<script>window.location.replace('index.php');</script>";
    }
}else{
    $_SESSION['loginErrors'] = "supecious";
    header('Location: index.php'); 
}

?>