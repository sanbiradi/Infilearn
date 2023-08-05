<?php session_start(); 
include('dbconnect.php');

$update_view = "UPDATE analytics SET views = views+1 WHERE id = '1'";
@$conn->query($update_view);
if(isset($_COOKIE['email']) && $_COOKIE['key']){
    header("Location: autoLogin.php");
}
if(isset($_SESSION['loggedin'])){
    echo "<script>window.location.replace('selectSubject.php');</script>";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fe4a55">

    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="keywords" content="Infilearn,free,e-learning,learning,platform,free learning">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="robots" content="index" />

    <meta name="googlebot" content="index">
    <meta name="googlebot-news" content="snippet">
    <!-- Generated -->
    <!-- Primary Meta Tags -->
    <title>InfiLearn - India's free E-learning platform</title>
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

    <link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registrationMesg.css">
    <link rel="stylesheet" href="css/login_validation.css">
    <link rel="stylesheet" href="css/errors.css">
</head>
<body>
    
    <?php include('header.php'); ?>
    
    <!-- advertising- Section -1 -->

    <section class="advertising-section"> 
        <div class="advertising-div">
            <div class="get-started-div">
                <h1>India's free innovative learning platform</h1>
                <p>Transform your life through E-Learning</p>
                <button class="advertising-section-get-started-btn" onclick="window.location.assign('signup.php');">Get Started</button>
            </div>

            <div class="advertising-pattern-div"></div><!-- Pattern -->
        </div>
    </section>

    <!-- Site Content section -2 -->

    <section class="site-content-section">
        <div class="site-content-div">
            <div class="site-content">
                <div class="site-content-viewboxes">   <!-- all viewboxs -->
                    
                    <!-- E-content viewbox -->
                    <div class="site-content-viewbox"> <!-- single viewbox -->
                        <div class="viewbox-common-img-bg">
                            <div id="viewbox-img-1" class="viewbox-image">
                                <!-- ViewBox image -->
                            </div>
                        </div>
                        <div class="viewbox-title">
                            <h2>E-Content</h2>
                            <p>Digitally created content</p>
                        </div>
                        <div class="viewbox-start-now">
                            <a onclick="ModalShow();" class="view-box-start-now-link">Start Now!</a>
                        </div>
                    </div>
                    <!-- Organised Syllabus viewbox -->
                    <div class="site-content-viewbox"> <!-- single viewbox -->
                        <div class="viewbox-common-img-bg">
                            <div id="viewbox-img-2" class="viewbox-image">
                                <!-- ViewBox image -->
                            </div>
                        </div>
                        <div class="viewbox-title">
                            <h2>Organised Syllabus</h2>
                            <p>Study material in an organised way</p>
                        </div>
                        <div class="viewbox-start-now">
                            <a onclick="ModalShow();" class="view-box-start-now-link">Start Now!</a>
                        </div>
                    </div>
                    <!-- 24x7 Syllabus Viewbox -->
                    <div class="site-content-viewbox"> <!-- single viewbox -->
                        <div class="viewbox-common-img-bg">
                            <div id="viewbox-img-3" class="viewbox-image">
                                <!-- ViewBox image -->
                            </div>
                        </div>
                        <div class="viewbox-title">
                            <h2>24x7 Accessible</h2>
                            <p>Learn at your schedule</p>
                        </div>
                        <div class="viewbox-start-now">
                            <a onclick="ModalShow();" class="view-box-start-now-link">Start Now!</a>
                        </div>
                    </div>
                </div>

                <div class="site-content-short-branding">
                    <h2 class="branding-title">Infi-Learn</h2>
                    <p class="branding-desc">"Infinite Learning"</p>
                    <h2 class="branding-info">A free learning E-Platform for all</h2>
                </div>
                
                <div class="site-content-pattern"></div><!-- Pattern -->
            </div>
        </div>
    </section>

    <!-- Hr  -->
    <hr class="section-2-hr">

    <!-- Grades Section 3-->

    <section class="grade-section">
        <div class="grade-div">
            <div class="grade-div-title">
                <h2>Grades</h2>
            </div>
            <div class="grade-div-all-grades"> <!-- all grades -->
                <!-- Grade 1 -->
                <div class="grade-div-grade"> <!-- Single grade -->
                    <a >
                        <span>1<sup>st</sup></span> <br> Grade
                    </a>
                </div>
                <!-- Grade 2 -->
                <div class="grade-div-grade"> <!-- Single grade -->
                    <a>
                        <span>2<sup>nd</sup></span> <br> Grade
                    </a>
                </div>
                <!-- Grade 3 -->
                <div class="grade-div-grade"> <!-- Single grade -->
                    <a >
                        <span>3<sup>rd</sup></span> <br> Grade
                    </a>
                </div>
                <!-- Grade 4 -->
                <div class="grade-div-grade"> <!-- Single grade -->
                    <a >
                        <span>4<sup>th</sup></span> <br> Grade
                    </a>
                </div>
                <!-- Grade 5 -->
                <div class="grade-div-grade"> <!-- Single grade -->
                    <a >
                        <span>5<sup>th</sup></span> <br> Grade
                    </a>
                </div>
            </div>

            <div class="grade-section-pattern"></div><!-- Pattern -->
        </div>
    </section>

    <!-- Stats Section 4-->

    <section  class="stats-section">
        <div class="stats-div">
            <div class="all-stats">
                <!-- Lessons stat -->
                <div class="single-stat">
                    <div class="stat-logo-bg">
                        <!-- stat logo bg -->
                        <div id="stat-icon-1" class="stat-logo-icon">
                            <!-- stat logo icon -->
                        </div>
                    </div>
                    <div class="stat-title">
                        <h2>Lessons</h2>
                    </div>
                    <div class="stat-count">
                        <h2>100+</h2>
                    </div>
                </div>
                <!-- Learners stat -->
                <div class="single-stat">
                    <div class="stat-logo-bg">
                        <!-- stat logo bg -->
                        <div id="stat-icon-2" class="stat-logo-icon">
                            <!-- stat logo icon -->
                        </div>
                    </div>
                    <div class="stat-title">
                        <h2>Learners</h2>
                    </div>
                    <div class="stat-count">
                        <h2>500+</h2>
                    </div>
                </div>
                <!-- Lessons stat -->
                <div class="single-stat">
                    <div class="stat-logo-bg">
                        <!-- stat logo bg -->
                        <div id="stat-icon-3" class="stat-logo-icon">
                            <!-- stat logo icon -->
                        </div>
                    </div>
                    <div class="stat-title">
                        <h2>Rates</h2>
                    </div>
                    <div class="stat-count">
                        <h2>10+</h2>
                    </div>
                </div>
                <!-- Lessons stat -->
                <div class="single-stat">
                    <div class="stat-logo-bg">
                        <!-- stat logo bg -->
                        <div id="stat-icon-4" class="stat-logo-icon">
                            <!-- stat logo icon -->
                        </div>
                    </div>
                    <div class="stat-title">
                        <h2>Teachers</h2>
                    </div>
                    <div class="stat-count">
                        <h2>90+</h2>
                    </div>
                </div>
            </div>

            <div class="stat-pattern"></div><!--stat Pattern -->
        </div>
    </section>

    <!-- Become an Instructor Section 5-->
    
    <section class="become-instructor-section">
        <div class="become-instructor-div">
            <div class="become-instructor-info">
                <h2 class="become-instructor-info-title">Become an instructor</h2>
                <p class="become-instructor-info-desc">InfiLearn comes with great feature, where anyone can teach for free</p>
                <button class="become-instructor-info-button" onclick="ModalShow();">Start teaching today</button>
                <p class="become-instructor-info-video-info">Check out <a onclick="ModalShowBecomeInstructor();">How you can?</a></p>
                
                <div class="become-instructor-pattern"></div><!-- Pattern -->
            </div>

            <div class="become-instructor-image"></div>
        </div>
    </section>

    <!-- contact us Section -6 -->

    <section class="contact-us-section">
        <div class="contact-us-div">
            
            <div class="contact-us-pattern-plane"></div><!-- Plane Pattern -->

            <div class="contact-us-subdiv">
                <h2 class="contact-us-title">We'd Love to hear from you</h2>
                <p class="contact-us-desc">Whether a question, doubt, need help, or anything else, contact our team</p>
                <button class="contact-us-button" onclick="window.location.assign('contactus.php');">Contact us</button>
            </div>
            <div class="contact-us-pattern-lines"></div><!--lines Pattern -->
        </div>

    </section>

    <!-- Footer -->

    <?php include('footer.php') ?>

    <?php include('howcanyou.php'); ?>

  <?php
  include('loginmodal.php');
if(isset($_SESSION['Registered'])){
    if($_SESSION['Registered'] == true){
        echo'
        <div id="background-visbility" class="background-visbility"></div>
        <div id="registration-successfull-modal" class="registration-successfull-modal">
            <div class="registration-symbol">
                <span>
                    <div class="svg-container">    
                        <svg class="ft-green-tick" xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="0 0 48 48" aria-hidden="true">
                            <circle class="circle" fill="#5bb543" cx="24" cy="24" r="22"/>
                            <path class="tick" fill="none" stroke="#FFF" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M14 27l5.917 4.917L34 17"/>
                        </svg>
                    </div>
                </span>
            </div>
            <div class="registration-mesg">
                <div class="registration-mesg-header">
                    <p>Registration Success!</p>
                </div>
                <div class="registration-mesg-info">
                    <p>We have sent a confirmation to your E-mail for verification.</p>
                </div>
                <div class="registration-mesg-login-btn">
                    <button onclick="AfterRegistrationLoginModal();">Login</button>
                </div>
            </div>
        </div>
        ';
        $_SESSION['Registered'] = "";
    }
    $_SESSION['Registered'] = "";
}

?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js" ></script>
  <script src="js/script.js" defer></script>
  <script src="js/hamburger.js" defer></script>
  <script src="js/validateForm.js" defer></script>
</body>
</html>
<!-- 


 --> 
<?php
if(isset($_SESSION['loginErrors'])){
    if(!$_SESSION['loginErrors'] == ""){
        if($_SESSION['loginErrors'] == "erroroccured"){
            echo '
                <div class="client-error-mesg">
                    <p>An Error Occured, Please Try Again</p>
                </div>';
            $_SESSION['loginErrors'] = "";
        }

        if($_SESSION['loginErrors'] == "loginfailed"){
            echo '
                <div class="client-error-mesg">
                    <p>Login Failed!, Try Again..</p>
                </div>';
            $_SESSION['loginErrors'] = "";
        }

        if($_SESSION['loginErrors'] == "noValueReturn"){
            echo '
                <div class="client-error-mesg">
                    <p>An Error Occured, Please Try Again</p>
                </div>';
            $_SESSION['loginErrors'] = "";
        }

        if($_SESSION['loginErrors'] == "supecious"){
            echo '
                <div class="client-error-mesg">
                    <p>Suspecious Activity Detected</p>
                </div>';
            $_SESSION['loginErrors'] = "";
        }

        if($_SESSION['loginErrors'] == "nouserfound"){
            echo '
                <div class="client-error-mesg">
                    <p>An Error Occured, Please Try Again</p>
                </div>';
            $_SESSION['loginErrors'] = "";
        }

        if($_SESSION['loginErrors'] == "blocked"){
            echo '
                <div class="client-error-mesg">
                    <p>You have been Blocked!</p>
                </div>';
            $_SESSION['loginErrors'] = "";
        }


        $_SESSION['loginErrors'] = "";
    }
    $_SESSION['loginErrors'] = "";
}

?>