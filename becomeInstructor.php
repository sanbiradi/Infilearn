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
    <title>Become Instructor | Infilearn</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/becomeInstructor.css">
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
    



    <section class="become-instructor-section" style="height: 90vh;">
        <div class="become-instructor-div">
             <div class="become-instructor-image"></div>

             <div class="become-instructor-info">
                <h2 class="become-instructor-info-title">Become A Teacher!</h2>
                <p class="become-instructor-info-desc">Memories the thoughts and see the open sense of<br> possibility which are the misteck you have did today</p>

                <form action="becomeInstructor.php" method="post">
                    <div class="teacher-dashboard-subject-upload-video-submit-data-terms">
                        <input type="checkbox" name="terms_conditns" id="terms-conditns" required><span class="checkmark"></span>
                        <span>I agree to <a onclick="ModalShowInstruction();">terms and conditions</a></span>
                    </div>
                    <button type="submit" name="become_instructor_btn" class="become-instructor-info-button" >Submit</button>
                </form>
                <div class="become-instructor-pattern"></div><!-- Pattern -->
            </div>
        </div>
    </section>


    <?php include('termsInstructorModal.php'); ?>


    <!-- Footer -->


    <!-- Modal -->
    
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous" ></script>
    <script src="js/script.js" ></script>
    <script src="js/hamburger.js"></script>
  
</body>
</html>

<?php 
if(isset($_POST['become_instructor_btn'])){
    if(isset($_POST['terms_conditns'])){
        $update_sql = "UPDATE user_login SET role = 'Teacher' WHERE userid = '$userId'";
        if($conn->query($update_sql) === TRUE){
            $_SESSION['usererrors'] = "instructorSuccess";
            echo "<script>window.location.replace('selectSubject.php');</script>";
        }else{
            echo '
                <div class="client-error-mesg">
                    <p>Error Occured, Please Try Again Later :(</p>
                </div>';
            echo '<script>window.history.replaceState( null, null, window.location.href );</script>';
        }
    }else{
        echo '
            <div class="client-error-mesg">
                <p>Please Read and Accept the Terms And Conditions :(</p>
            </div>';
        echo '<script>window.history.replaceState( null, null, window.location.href );</script>';
    }
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