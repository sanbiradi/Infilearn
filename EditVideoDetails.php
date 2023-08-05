<?php
session_start();
include('dbconnect.php');
if ($_SESSION['role_pre'] == "Admin") {
    if (isset($_GET['key'])) {
        if ($_GET['key'] != "") {

            $video_upload_id =  mysqli_escape_string($conn, $_GET['key']);

            
            $username = $_SESSION['username'] ;
            // $_SESSION['board'] = $board;
            // $_SESSION['class'] = $class;
            $profileImg = $_SESSION['profileImg'];
?>


            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="theme-color" content="#fe4a55">
                <title>Admin Panel | Infilearn</title>
                <link rel="stylesheet" href="css/style.css">
                <link rel="stylesheet" href="css/admin.css">
                <link rel="stylesheet" href="css/errors.css">
                <link rel="stylesheet" href="css/validation.css">
                <link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">

            </head>

            <body>
                <header>
                    <div class="subject-dashboard-header-desktop">
                        <div id="teacher-infilearn-logo" class="subject-dashboard-header-title">
                            <a href="index.php">
                                <img class="infilearn-logo" src="content/icons/new.png" alt="Infilearn Logo" height="60px">
                            </a>
                        </div>
                        <div class="subject-dashboard-header-search-bar">
                            <!-- Null -->
                        </div>
                        <div class="subject-dashboard-header-profile">
                            <div class="subject-dashboard-header-profile-box">
                                <p><?php echo @$username; ?></p>
                                <div class="subject-dashboard-profile-dp" onclick="showDrpDwn();">
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


                <?php

                $sql = "SELECT * FROM videouploaded WHERE id = '$video_upload_id' ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $db_title_video = $row['title'];
                        $db_title_desc = $row['description'];
                    }



                ?>


                    <div style="width:100vh;position:absolute;top:12vh;left:35vh;">

                        <div class="teacher-dashboard-subject-upload-video-title">
                            <h3>Upload Video</h3>
                        </div>
                        <form id="videoUploadAdmin" action="editVideoUpload.php?key=<?php echo $video_upload_id; ?>" method="post" enctype="multipart/form-data">
                            <div class="teacher-dashboard-subject-upload-video-input-data">
                                <div class="teacher-dashboard-subject-upload-video-right-inputs">

                                    <div class="teacher-dashboard-subject-upload-video-textbox topic">
                                        <label for="video-title">Title</label>
                                        <input type="text" name="video_title" id="video-title" required minlength="8" value="<?php echo $db_title_video ?>">
                                    </div>
                                    <div class="teacher-dashboard-subject-upload-video-textbox-description">
                                        <label id="label-for-board-select" for="teacher-description-box">Description</label> <br>
                                        <textarea name="video_desc" id="teacher-description-box" cols="30" rows="10">
                                            <?php echo $db_title_desc ?>
                                            </textarea>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="teacher-dashboard-subject-upload-video-submit-data">
                                <div class="teacher-dashboard-subject-upload-video-submit-data-btns">
                                    <input type="submit" value="Update" name="update_videos_btn">
                                    <input type="button" value="Back" onclick="EditVideoBackFunc()">
                                </div>
                            </div>
                        </form>
                    </div>
                    <script src="js/script.js"></script>

            </body>

            </html>


<?php
                    
                }
            } else {
                echo "<script>window.location.replace('adminPanel.php');</script>";
            }
        } else {
            echo "<script>window.location.replace('adminPanel.php');</script>";
        }
        
    } else {
        $_SESSION['loginErrors'] = "supecious";
        header('Location: index.php');
    }

?>