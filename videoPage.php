<?php
session_start();
include('dbconnect.php');
if (isset($_SESSION['loggedin'])) {
    if (isset($_SESSION['userid'])) {

        if (isset($_GET['t'])) {
            if (isset($_GET['n'])) {
                if (isset($_GET['key'])) {


                    $Session_username = $_SESSION['username'];
                    $Session_board = $_SESSION['board'];
                    $Session_class = $_SESSION['class'];
                    $Session_profileImg = $_SESSION['profileImg'];

                    $videoID = mysqli_escape_string($conn, $_GET['key']);
                    $_SESSION['video_id_curr'] = $videoID;
                    $topic_name_url =  mysqli_escape_string($conn, $_GET['t']);
                    $title_name_url =  mysqli_escape_string($conn, $_GET['n']);

                    $conn->query("UPDATE videouploaded SET 	views=views+1 WHERE id='$videoID'");

                    $sql_topics = "SELECT * FROM videouploaded WHERE id = $videoID";
                    $result = $conn->query($sql_topics);
                    if (@$result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $db_standard    = $row['standard'];
                            $db_board       =  $row['board'];
                            $db_subject     = $row['subject'];
                            $db_chapter     = $row['chapter'];
                            $db_topic       = $row['topic'];
                            $db_videopath   = $row['filepath'];
                            $db_title       = $row['title'];
                            $db_description = $row['description'];
                            $db_uploadtime  = $row['uploadtime'];
                            $db_email       = $row['email'];
                            $db_isaccepted  = $row['isaccepted'];
                            $db_views       = $row['views'];
                            $db_thumbnail   = $row['thumbnail'];

                            $db_topic_arr[] = $row['topic'];
                            $db_title_arr[] = $row['title'];
                        }
                        if (in_array($topic_name_url, $db_topic_arr) && in_array($title_name_url, $db_title_arr)) {

?>
                            <html lang="en">

                            <head>
                                <meta charset="UTF-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <meta name="theme-color" content="#221638">
                                <title><?php echo $db_title; ?></title>
                                <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
                                <link rel="stylesheet" href="css/videopage.css">
                                <link rel="stylesheet" href="css/style.css">
                                <link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">


                            </head>

                            <body>
                                <header>
                                    <div class="chapter-video-page-desktop-header">
                                        <div class="select-subject-desktop-logo">
                                            <a href="index.php">
                                                <img class="infilearn-logo" src="content/icons/new.png" alt="Infilearn Logo" height="60px">
                                            </a>
                                        </div>
                                        <div class="select-subject-dashboard-header-profile">
                                            <div class="select-subject-dashboard-header-profile-box">
                                                <p id="chapter-video-page-user-name"><?php echo @$Session_username; ?></p>
                                                <div class="select-subject-dashboard-profile-dp" onclick="showDrpDwn();">
                                                    <?php
                                                    if (!$Session_profileImg == "") {
                                                    ?>
                                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($Session_profileImg); ?>" alt="user profile" height="35px" width="35px">
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

                                <!-- Video Player Section  -->
                                <section class="section-video-page-video-player-section">
                                    <div class="section-video-player-div">
                                        <div class="section-video-player-back-btn-and-chapter-title">
                                            <div class="section-video-player-back-btn">
                                                <button onclick="window.location.assign('index.php');"><img src="content/icons/arrow-btn.svg" alt="back button" class="section-video-player-back-btn-img" height="16px"></button>
                                            </div>
                                            <div class="section-video-player-chapter-title">
                                                <h2><?php echo $db_chapter; ?></h2>
                                            </div>
                                        </div>
                                        <div class="section-video-player-video-container">
                                            <div class="container">
                                                <div class="video-player-container">
                                                    <video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="640" height="264" poster="<?php echo "data:image/jpg;charset=utf8;base64," . base64_encode($db_thumbnail); ?>" data-setup="{}">
                                                        <source src="<?php echo $db_videopath; ?>" type="video/mp4">
                                                        <p class="vjs-no-js">
                                                            To view this video please enable JavaScript, and consider upgrading to a
                                                            web browser that
                                                            
                                                        </p>
                                                    </video>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section-video-player-video-title-and-details">
                                            <div class="section-video-player-video-title">
                                                <h2><?php echo $db_title; ?></h2>
                                            </div>
                                            <div class="section-video-player-video-details">
                                                <div class="section-video-player-video-detail-author">
                                                    <p><?php echo $db_email; ?></p>
                                                </div>
                                                <div class="section-video-player-video-detail-view-release-date">
                                                    <p><?php echo $db_views; ?> views • <?php echo substr_replace($db_uploadtime, "", 10); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="video-detai-end-hr">
                                        <div class="section-video-player-video-desc-and-data">
                                            <div class="section-video-player-video-tab-pane">
                                                <ul>
                                                    <li class="active"><a onclick="showDesc();">Description</a></li>
                                                    <li><a onclick="showqna();">Q&A</a></li>
                                                    <li><a onclick="showFiles();">Study Material</a></li>
                                                </ul>
                                                <div class="active_underline"></div>
                                            </div>
                                            <div class="section-video-player-video-data-section">
                                                <!-- Video data description -->
                                                <div id="video-description" class="section-video-player-video-data-description">
                                                    <p style="padding-bottom: 80px;">
                                                        <?php echo $db_description; ?>
                                                    </p>
                                                </div>
                                                <!-- Video data QNA -->
                                                <div id="video-Qna" class="section-video-player-video-data-qna">
                                                    <form method="POST" id="commentForm">
                                                        <div class="section-video-player-video-data-qna-add-comment">
                                                            <div class="section-video-player-video-data-qna-add-comment-input">
                                                                <input type="hidden" name="name" id="name" value="<?php echo $Session_username; ?>" />
                                                                <input type="text" name="comment" id="comment" placeholder="Ask a question" required>
                                                            </div>
                                                            <div class="section-video-player-video-data-qna-submit-comment-btn">
                                                                <input type="button" value="Cancel">
                                                                <input type="submit" name="submit" id="submit" value="Submit">
                                                                <input type="hidden" name="commentId" id="commentId" value="0" />
                                                            </div>
                                                        </div>
                                                    </form>
                                                    
                                                    <div class="section-video-player-video-data-qna-all-comments">
                                                        <div id="showComments"></div>
                                                    </div>
                                                </div>
                                                <!-- Video data Files -->
                                                <div id="video-files" class="section-video-player-video-data-files">
                                                    <div class="section-video-player-video-data-all-files">
                                                        <!-- 1 file -->

                                                        <?php
                                                        $sql_pdfs = "SELECT * FROM fileuploaded WHERE board = '$db_board' AND standard = '$db_standard' AND subject = '$db_subject' AND chapter = '$db_chapter' AND topic = '$db_topic' ";
                                                        $result = $conn->query($sql_pdfs);
                                                        if (@$result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {

                                                                $sugg_file_path = $row['filepath'];
                                                                $sugg_file_title = $row['title'];
                                                                $pdfId =  $row['id'];

                                                        ?>
                                                                <a onclick="UpdateDownloadFile(<?php echo $pdfId; ?>);" href="<?php echo $sugg_file_path; ?>" style="text-decoration: none; cursor:pointer;" download="<?php echo $sugg_file_title;  ?>">
                                                                    <div class="section-video-player-video-data-single-file">
                                                                        <div class="section-video-player-video-data-single-file-img">
                                                                            <!-- File Image -->
                                                                        </div>
                                                                        <div class="section-video-player-video-data-single-file-name">
                                                                            <h3><?php echo $sugg_file_title; ?></h3>
                                                                        </div>
                                                                    </div>
                                                                </a>

                                                        <?php
                                                            }
                                                        }else{
                                                            ?>
                                                                <p style="padding-bottom: 60px;">No PDF Available!</p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Video Suggestion Division -->
                                    <div class="section-video-suggestion-div">
                                        <div class="section-video-suggestion-title">
                                            <h3>Other Topics</h3>
                                        </div>
                                        <div class="section-video-suggestion-all-videos">
                                            <!-- 1st suggestion video -->
                                            <?php
                                            $sql_topics = "SELECT * FROM videouploaded WHERE board = '$db_board' AND standard = '$db_standard' AND subject = '$db_subject' AND chapter = '$db_chapter'  ";
                                            $result = $conn->query($sql_topics);
                                            if (@$result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {

                                                    $sugg_vid_id = $row['id'];
                                                    $sugg_vid_topic = $row['topic'];
                                                    $sugg_vid_thumbnail = $row['thumbnail'];
                                                    $sugg_vid_title = $row['title'];
                                                    $sugg_vid_chapter = $row['chapter'];
                                                    $sugg_vid_user = $row['email'];
                                                    $sugg_vid_views = $row['views'];
                                                    $sugg_vid_date = $row['uploadtime'];
                                            ?>
                                                    <div class="section-video-suggestion-single-video" style="cursor: pointer;" onclick="window.location.assign('videoPage.php?t=<?php echo $sugg_vid_topic; ?>&n=<?php echo $sugg_vid_title; ?>&key=<?php echo $sugg_vid_id; ?>')">
                                                        <div class="section-video-suggestion-video-thumbnail">
                                                            <?php
                                                            if (!$sugg_vid_thumbnail == "") {
                                                            ?>
                                                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($sugg_vid_thumbnail); ?>" alt="video thumbnail" height="85px" width="140px">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="content/default/defaultThumbnail.png" alt="video thumbnail" height="85px">
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <div class="section-video-suggestion-video-title-and-info">
                                                            <h4><?php echo substr_replace($sugg_vid_title, "...", 30); ?></h4>
                                                            <h5>Chapter: <?php echo substr_replace($sugg_vid_chapter, "...", 30); ?></h5>
                                                            <p><?php echo substr_replace($sugg_vid_user, "...", 40); ?></p>
                                                            <p><?php echo $sugg_vid_views; ?> views • <?php echo substr_replace($sugg_vid_date, "", 10); ?></p>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </section>

                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous"></script>
                                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
                                <script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
                                <script src="https://code.jquery.com/jquery-1.11.2.min.js" ></script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                                <script src="js/videopage.js" defer></script>
                                <script src="js/script.js" defer></script>
                                <script src="js/addData.js"></script>
                                <script src="js/comments.js"></script>


                                <!-- <script src="js/videoRefresh.js"></script> -->
                            </body>

                            </html>

                            
<?php

                               


                        } else {
                            $_SESSION['usererrors'] = "illeggal";
                            echo "<script>window.location.replace('selectSubject.php');</script>";
                        }
                    } else {
                        $_SESSION['usererrors'] = "illeggal";
                        echo "<script>window.location.replace('selectSubject.php');</script>";
                    }
                } else {
                    $_SESSION['usererrors'] = "illeggal";
                    echo "<script>window.location.replace('selectSubject.php');</script>";
                }
            } else {
                $_SESSION['usererrors'] = "illeggal";
                echo "<script>window.location.replace('selectSubject.php');</script>";
            }
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
?>