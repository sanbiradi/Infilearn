<?php
session_start();
include('dbconnect.php');
if (isset($_SESSION['loggedin'])) {
    if (isset($_SESSION['userid'])) {
        if (isset($_GET['s'])) {
            if ($_GET['s'] != "") { 
                $subjectname = mysqli_escape_string($conn,  $_GET['s']);

                $subjet_arr = $_SESSION['subject_arr'];

                if (in_array($subjectname, $subjet_arr)) {

                    $username = $_SESSION['username'];
                    $board = $_SESSION['board'];
                    $class = $_SESSION['class'];
                    $profileImg = $_SESSION['profileImg'];
                    $int_class = $class;
                    if ($class == "1") {
                        $class = $class . "st";
                    }
                    if ($class == "2") {
                        $class = $class . "nd";
                    }
                    if ($class == "3") {
                        $class = $class . "rd";
                    }
                    if ($class == "4") {
                        $class = $class . "th";
                    }
                    if ($class == "5") {
                        $class = $class . "th";
                    }
?>

                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta name="theme-color" content="#fe4a55">
                        <title><?php echo $class . " Class " . $subjectname . " " . $board . " Content | InfiLearn" ?></title>
                        <link rel="stylesheet" href="css/style.css">
                        <link rel="stylesheet" href="css/errors.css">
                        <link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">

                    </head>

                    <body>
                        <header>
                            <div class="subject-dashboard-header-desktop">
                                <div id="mobile-hamburger-icon" class="mobile-hamburger-icon">
                                    <div id="subject-dashboard-hamburger" class="hamburger-mobile col" onclick="showMobileDashboardNav()">
                                        <div class="hamburger" id="hamburger-3">
                                            <span class="line"></span>
                                            <span class="line"></span>
                                            <span class="line"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="subject-dashboard-header-title">
                                    <a href="index.php">
                                        <img class="infilearn-logo" src="content/icons/new.png" alt="Infilearn Logo" height="60px">
                                    </a>
                                </div>
                                <div class="subject-dashboard-header-search-bar">
                                    <div class="subject-dashboard-search-bar-box">
                                        <input type="text" name="dashboard-search" id="dashboard-search" placeholder="Search for anything">
                                        <input type="button" value="">
                                    </div>
                                </div>
                                <div class="subject-dashboard-header-profile">
                                    <div class="select-subject-dashboard-header-profile-box">
                                        <p><?php echo @$username; ?></p>
                                        <div class="select-subject-dashboard-profile-dp" onclick="showDrpDwn();">
                                            <?php
                                            if (!$profileImg == "") {
                                            ?>
                                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($profileImg); ?>" alt="user profile" height="35px" width="35px">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="content/default/defaultprofile.png" alt="user profile" height="35px" width="35px">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <!--Dashboard user Profile Photo-->
                                    </div>
                                    <div id="subject-dashboard-profile-drowdown" class="subject-dashboard-profile-drowdown">
                                        <a href="profile.php">Profile</a>
                                        <hr class="dropdwon-profile-hr">
                                        <a href="logout.php">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <section class="subject-dashboad-content">
                            <div class="subject-dashboard-content-div">
                                <!-- Subject navigation Bar -->
                                <div id="subject-content-navigation-bar" class="subject-content-navigation-bar">
                                    <div class="subject-dashboard-nav-class-and-subject-name">
                                        <button onclick="window.history.back()"><img src="content/icons/arrow-btn.svg" alt="back button" class="section-video-player-back-btn-img" height="16px"></button>
                                        <h2 class="subject-dashboard-nav-class-name"><?php echo $class; ?> Standard</h2>
                                        <h2 class="subject-dashboard-nav-subject-name"><?php echo $subjectname; ?></h2>
                                    </div>
                                    <div class="subject-dashboard-nav-chapter-title">
                                        <h2>Chapters</h2>
                                    </div>
                                    <div class="subject-dashboard-nav-all-chapter-names">
                                        <?php
                                        $sql = "SELECT * FROM chapters WHERE board = '$board' AND subjectname = '$subjectname'  AND standard = '$int_class'";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $chapterName = $row['chaptername'];
                                                $chapterArr[] = $row['chaptername'];
                                        ?>
                                                <div class="subject-dashboard-nav-single-chapter-name">
                                                    <a href="dashboard.php?s=<?php echo $subjectname . '&c=' . $chapterName; ?>" class="subject-dashboard-nav-chapter-name">
                                                        <span class="subject-dashboard-nav-chapter-no"><?php echo $i; ?>.</span>
                                                        <span> <?php echo $chapterName; ?></span>
                                                    </a>
                                                </div>
                                                <hr class="subject-dashboard-nav-single-chapter-hr">
                                            <?php
                                                $i++;
                                            }
                                        } else {
                                            ?>
                                            <div class="subject-dashboard-nav-single-chapter-name">
                                                <a href="" class="subject-dashboard-nav-chapter-name">
                                                    <span class="subject-dashboard-nav-chapter-no"></span>
                                                    <span style="margin-left: 30px;">No Chapters Found!!</span>
                                                </a>
                                            </div>
                                            <hr class="subject-dashboard-nav-single-chapter-hr">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- Subject chapter Content  -->
                                <?php
                                if (isset($_GET['c'])) {
                                    if (!$_GET['c'] == "") {
                                        $chapterName_Url = mysqli_escape_string($conn, $_GET['c']);
                                        if (in_array($chapterName_Url, $chapterArr)) {
                                            $valid_Chapter_name = false;
                                            $sql = "SELECT * FROM chapters WHERE board = '$board' AND subjectname = '$subjectname' AND standard = '$int_class' AND chaptername = '$chapterName_Url'";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $chapterName_db  = $row['chaptername'];
                                                    $topics = $row['topics'];
                                                    $description = $row['description'];
                                                    $topicIds = $row['topicsids'];
                                                    if ($chapterName_Url == $row['chaptername']) {
                                                        $valid_Chapter_name = true;
                                                    } else {
                                                        $valid_Chapter_name = false;
                                                    }
                                                    if ($description == "") {
                                                        $description = "Description for this Chapter is not available! :(";
                                                    }
                                                }

                                                if ($valid_Chapter_name == true) {

                                                    $topics_array = unserialize($topicIds);
                                                    @$topic_str =  implode(", ", $topics_array);
                                                    $db_topic_videoid = '';
                                                    
                                                    $sql_topics = "SELECT * FROM topics WHERE id IN ($topic_str)";
                                                    // echo $sql_topics;
                                                    $result = $conn->query($sql_topics);
                                                    if (@$result->num_rows > 0) {
                                                        $array_id_storage = array();
                                                        $i = 0;
                                                        while ($row = $result->fetch_assoc()) {
                                                            $db_topicname = $row['topicname'];
                                                            if($row['videoids'] != 'null'){
                                                                $db_topic_videoid = $row['videoids'];
                                                                array_push($array_id_storage, $db_topic_videoid);
                                                                
                                                            }
                                                        }
                                                    
                                ?>
                                                    <div class="subject-dashboard-content-section">
                                                        <div class="subject-dashboard-content-section-chapter-title">
                                                            <div class="subject-dashboard-content-section-chapter-title-icon">
                                                                <!-- Icon Here -->
                                                            </div>
                                                            <div class="subject-dashboard-content-section-chapter-title-info">
                                                                <h2><?php echo $chapterName_db; ?></h2>
                                                                <!-- <p class="subject-dashboard-content-section-chapter-title-info-p">This is helpful sub description</p> -->
                                                                <div class="subject-dashboard-content-section-chapter-title-info-topics-and-duration">
                                                                    <p>Topic: <?php echo $topics; ?></p>
                                                                    <!-- <p>Duration: 4hrs</p> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="subject-dashboard-content-section-chapter-videos">
                                                            <div class="subject-dashboard-content-section-chapter-desc">
                                                                <h2>Description</h2>
                                                                <p><?php echo $description; ?></p>
                                                            </div>
                                                            <div class="subject-dashboard-content-section-chapter-all-videos">

                                                            <?php

                                                                if($db_topic_videoid){
                                                                    

                                                                    $db_topic_videoid_arr = array();
                                                                    $temp_arr = array();

                                                                    for ($i=0; $i < sizeof($array_id_storage) ; $i++) {
                                                                        $array_id_str = $array_id_storage[$i];
                                                                        $temp_arr = unserialize($array_id_str);

                                                                        for ($j=0; $j < sizeof($temp_arr) ; $j++) { 
                                                                            array_push($db_topic_videoid_arr, $temp_arr[$j]);
                                                                        }
                                                                        
                                                                    }
                                                                    

                                                                    // for ($i=0; $i < sizeof($array_id_storage); $i++) { 
                                                                    //     $a = $array_id_storage[$i];
                                                                    //     for ($j=0; $j < count($array_id_storage); $j++) {
                                                                    //         $c = $a;
                                                                            
                                                                    //         // break;
                                                                    //         $topic_single_id_arr = unserialize($c);
                                                                    //         $temp_id = $topic_single_id_arr[$j];
                                                                    //         array_push($temp_arr, $temp_id);
                                                                    //     }                                                      
                                                                        
                                                                    //     $b = implode(',', $temp_arr);
                                                                        
                                                                        
                                                                        
                                                                        
                                                                    //     array_push($db_topic_videoid_arr, $b);
                                                                        
                                                                    // }
                                                                    

                                                                
                                                                    // $topics_array_str = unserialize($db_topic_videoid);
                                                                    
                                                                    // $adf = $_SESSION['db_topic_videoid_arr'];
                                                                    // $topics_array_arr = unserialize($adf);
                                                                    @$video_arr_str =  implode(", ", $db_topic_videoid_arr);
                                                                    
                                                                    $sql_topics = "SELECT * FROM videouploaded WHERE id IN ($video_arr_str)";
                                                                    $result = $conn->query($sql_topics);
                                                                    if (@$result->num_rows > 0) {
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $video_Uploaded_Id =  $row['id'];
                                                                            $video_Uploaded_title = $row['title'];
                                                                            $video_Uploaded_description =  $row['description'];
                                                                            $video_Uploaded_topic = $row['topic'];
                                                                            $video_Uploaded_thumbnail = $row['thumbnail'];
                                                                            $video_Uploaded_email = $row['email'];

                                                                            ?>
                                                                                <div class="subject-dashboard-content-section-chapter-single-video">
                                                                                    <div class="subject-dashboard-content-section-chapter-single-vid-img">
                                                                                        <?php
                                                                                            if($video_Uploaded_thumbnail == ""){
                                                                                                ?>
                                                                                                    <img src="content/default/defaultThumbnail.png" alt="Video Thumbnail" height="150px" width="230px">
                                                                                                <?php
                                                                                            }else{
                                                                                                ?>
                                                                                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($video_Uploaded_thumbnail); ?>" alt="Video Thumbnail" height="150px" width="230px" />
                                                                                                <?php
                                                                                            }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="subject-dashboard-content-section-chapter-single-vid-title-desc">
                                                                                        <h2 class="subject-dashboard-content-section-chapter-single-vid-title-desc-h2"><?php echo $video_Uploaded_title; ?></h2>
                                                                                        <p class="single-video-thumbnail-desc">
                                                                                            <?php echo substr_replace($video_Uploaded_description, "...", 150);?>
                                                                                        </p>
                                                                                        <div class="subject-dashboard-content-section-chapter-single-vid-play-btn-author">
                                                                                            <!-- <form action="videoIdPasser.php" method="post"> -->
                                                                                                <!-- <input type="hidden" name="video_item" id="video-item" value="<?php echo $video_Uploaded_Id; ?>"> -->
                                                                                            <button class="video-section-play-vid-btn" type="submit" name="play_btn" onclick="window.location.assign('videoPage.php?t=<?php echo $video_Uploaded_topic; ?>&n=<?php echo $video_Uploaded_title; ?>&key=<?php echo $video_Uploaded_Id; ?>')">Play</button>
                                                                                            <!-- </form> -->
                                                                                            <p class="sub-dash-single-vid-topic-name">Topic Name : <?php echo substr_replace($video_Uploaded_topic, "...", 60); ?></p>
                                                                                            <p class="sub-dash-single-vid-creator-name">by ~ <?php echo $video_Uploaded_email; ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>



                                                                            <?php
                                                                        }
                                                                    
                                                            ?>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php
                                                                    }else{
                                                                        ?>
                                                                            <p style="font-family: 'Nunito';font-size:4vh">No Video Found, Please Try Again After Some Time</p>
                                                                        <?php
                                                                    }
                                                    }else{
                                                        ?>
                                                            <p style="font-family: 'Nunito';font-size:4vh">No Topic Found, Please Try Again After Some Time</p>
                                                        <?php
                                                    }
                                                }else{
                                                    ?>
                                                    <div class="no-chapter-found-error-mesg">
                                                        <div class="no-chapter-found-error-mesg-div">
                                                            <p>No Topic Found, Please Try Again After Some Time</p>
                                                        </div>
                                                        <img src="content/error-icons/no_data.svg" alt="" height="200px">
                                                    </div>
                                                    
                                                    <?php
                                                }
                                                } else {
                                                ?>

                                                    <div class="no-chapter-found-error-mesg">
                                                        <div class="no-chapter-found-error-mesg-div">
                                                            <p>This is not valid chapter</p>
                                                        </div>
                                                        <img src="content/error-icons/no_data.svg" alt="" height="200px">
                                                    </div>

                                                <?php
                                                }
                                            } else {
                                                ?>

                                                <div class="no-chapter-found-error-mesg">
                                                    <div class="no-chapter-found-error-mesg-div">
                                                        <p>This is not valid chapter</p>
                                                    </div>
                                                    <img src="content/error-icons/no_data.svg" alt="" height="200px">
                                                </div>

                                        <?php
                                            }
                                        } else {
                                            $_SESSION['usererrors'] = "illeggal";
                                            echo "<script>window.location.replace('selectSubject.php');</script>";
                                        }
                                    } else {
                                        ?>

                                        <div class="no-chapter-found-error-mesg">
                                            <div class="no-chapter-found-error-mesg-div">
                                                <p>Please Select a chapter</p>
                                            </div>
                                            <img src="content/error-icons/no_data.svg" alt="" height="200px">
                                        </div>

                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="no-chapter-found-error-mesg">
                                        <div class="no-chapter-found-error-mesg-div">
                                            <p>No Data Found</p>
                                        </div>
                                        <img src="content/error-icons/no_data.svg" alt="" height="200px">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </section>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous"></script>
                        <script src="js/script.js" defer></script>
                        <script src="js/hamburger.js" defer></script>
                        <script src="js/dashboard.js" defer></script>
                        <script src="js/videoRefresh.js"></script>

                    </body>

                    </html>

<?php
                } else {
                    $_SESSION['usererrors'] = "illeggal";
                    echo "<script>window.location.replace('selectSubject.php');</script>";
                }
            } else {
                $_SESSION['loginErrors'] = "nouserfound";
                echo "<script>window.location.replace('index.php');</script>";
            }
        } else {
            $_SESSION['loginErrors'] = "supecious";
            header('Location: index.php');
        }
    } else {
        $_SESSION['loginErrors'] = "nouserfound";
        echo "<script>window.location.replace('index.php');</script>";
    }
} else {
    $_SESSION['loginErrors'] = "supecious";
    header('Location: index.php');
}
?>