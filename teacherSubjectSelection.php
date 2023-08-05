<?php
session_start();
include('dbconnect.php');
if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['loggedin'] == true) {
        if (isset($_SESSION['userid'])) {

            $userId = $_SESSION['userid'];
            $getInfo = false;

            $sql = "SELECT * FROM user_login";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dbUserId = $row['userid'];
                    $dbUsername = $row['name'];
                    $dbBoard = $row['board'];
                    $dbClass = $row['standard'];
                    $dbRole = $row['role'];
                    $dbProfileimg = $row['profileimg'];
                    $dbemail = $row['email'];
                    if ($userId ==  $dbUserId) {
                        $getInfo = true;
                        break;
                    } else {
                        $getInfo = false;
                    }
                }
                if ($getInfo == true) {
                    $username = $dbUsername;
                    $board = $dbBoard;
                    $class = $dbClass;
                    $role =  $dbRole;
                    $profileImg = $dbProfileimg;
                    $email = $dbemail;

                    $_SESSION['username'] = $username;
                    $_SESSION['board'] = $board;
                    $_SESSION['class'] = $class;
                    $_SESSION['profileImg'] = $profileImg;
                    $_SESSION['email'] = $email;

                    if ($role != "Teacher") {
                        if ($role == "Student") {
                            echo "<script>window.location.replace('selectSubject.php');</script>";
                        }
                        if ($role == "Admin") {
                            echo "<script>window.location.replace('adminPanel.php');</script>";
                        } else {
                            $_SESSION['loginErrors'] = "noValueReturn";
                            echo "<script>window.location.replace('index.php');</script>";
                        }
                    }
                }
                if ($getInfo == false) {
                    $username = "Username";
                    $board = "Board";
                    $class = "Class";
                    $role =  "Suspecious";
                    $profileImg = "Invalid";
                    $_SESSION['loginErrors'] = "noValueReturn";
                    echo "<script>window.location.replace('logout.php');</script>";
                }
            }

?>

            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="theme-color" content="#221638">
                <title>Teacher Dashboard | Infilearn</title>
                <link rel="stylesheet" href="css/style.css">
                <link rel="stylesheet" href="css/admin.css">
                <link rel="stylesheet" href="css/errors.css">
                <link rel="stylesheet" href="css/validation.css">
                <link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">

            </head>

            <body>
                <header>
                    <div class="subject-dashboard-header-desktop">
                        <div id="mobile-hamburger-icon" class="mobile-hamburger-icon">
                            <div id="subject-dashboard-hamburger" class="hamburger-mobile col" onclick="showMobileDashboardNavTeacher()">
                                <div class="hamburger" id="hamburger-3">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </div>
                            </div>
                        </div>
                        <div id="teacher-infilearn-logo" class="subject-dashboard-header-title">
                            <a href="index.php">
                                <img class="infilearn-logo" src="content/icons/new.png" alt="Infilearn Logo" height="60px">
                            </a>
                        </div>
                        <div class="subject-dashboard-header-search-bar">
                            <!-- <div class="subject-dashboard-search-bar-box">
                    <input type="text" name="dashboard-search" id="dashboard-search" placeholder="Search for anything">
                    <input type="button" value="">
                </div> -->
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

                <!-- Section Select subject -->

                <section class="teacher-dashboard-section">
                    <div class="teacher-dashboard-content-div">
                        <!-- TEACHER Subject navigation Bar -->
                        <div id="teacher-dashboard-content-navigation-bar" class="subject-content-navigation-bar">
                            <ul class="teacher-dashboard-content-navigation-bar-ul">
                                <li>
                                    <a class="teacher-dashboard-nav-links" onclick="showTechContent('video-upload');" href="#">
                                        <img src="content/icons/file_upload_white_24dp.svg" alt="video upload" height="35px">
                                        <span>Upload Videos</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="teacher-dashboard-nav-links" onclick="showTechContent('file-upload');" href="#">
                                        <img src="content/icons/file.svg" alt="file upload" height="35px">
                                        <span>Upload Files</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="teacher-dashboard-nav-links" onclick="showTechContent('show-history');" href="#">
                                        <img src="content/icons/history_white_36dp.svg" alt="history" height="35px">
                                        <span>History</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- teacher Subject content upload panel -->

                        <div id="teacher-dashboard-content-upload-content" class="teacher-dashboard-content-upload-content">
                            <div id="teacher-sec-back-btn" class="teacher-section-floating-back-btn">
                                <button onclick="showTechContent('show-subjects');"><img src="content/icons/arrow-btn.svg" alt="back button" class="section-video-player-back-btn-img" height="16px"></button>
                            </div>
                            <div id="teacher-subject-sel-panel" class="teacher-dashboard-subject-selection-panel">
                                <div id="teacher-select-subject-div" class="select-subject-div">
                                    <div class="select-subject-div-title">
                                        <h2>Select a subject</h2>
                                    </div>
                                    <div class="select-subject-div-all-subjects">

                                        <?php
                                        $sql = "SELECT * FROM subjects WHERE board='$board' AND standard='$class'";
                                        $result = $conn->query($sql);
                                        if (@$result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $subDb_subject = $row['subjectname'];
                                                $subDb_Url = $row['imagepath'];
                                        ?>
                                                <div class="select-subject-single-sub" onclick="window.location.assign('dashboard.php?s=<?php echo $subDb_subject; ?>&c=');">
                                                    <div class="select-subject-img">
                                                        <img src="<?php echo $subDb_Url; ?>" alt="subject image" height="120px">
                                                    </div>
                                                    <div class="selec-subject-div-subject-name">
                                                        <h3><?php echo $subDb_subject; ?></h3>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            $_SESSION['usererrors'] = "errorOccured";
                                            echo '  <p class="no-subject-mesg-db">
                                                    <h3 class="no-subject-mesg-h3">No Subject Found</h3>
                                                </p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div id="teacher-sub-upload-vid" class="teacher-dashboard-subject-upload-video">
                                <div class="teacher-dashboard-subject-upload-video-title">
                                    <h3>Upload Video</h3>
                                </div>
                                <form id="videoUpload" action="uploadvideo.php" method="post" enctype="multipart/form-data">
                                    <div class="teacher-dashboard-subject-upload-video-input-data">
                                        <div class="teacher-dashboard-subject-upload-video-left-inputs">
                                            <div class="teacher-dashboard-subject-upload-video-textbox board">
                                                <label for="board-select">Board</label>
                                                <select class="teacher-dashboard-input" name="board_select" id="board-select" required>
                                                    <option disabled selected>Select Board</option>
                                                    <option value="SSC">Maharashtra State Board</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox class">
                                                <label for="board-select">Class</label>
                                                <select class="teacher-dashboard-input" name="class_select" id="class-select" required>
                                                    <option disabled selected>Select Class</option>
                                                    <?php
                                                    $sql = "SELECT * FROM classes WHERE board = '$board' ORDER BY standard";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $standardName = $row['standard'];
                                                    ?>
                                                            <option value="<?php echo $standardName; ?>"><?php echo $standardName; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option disabled selected>No Class Found</option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox subject">
                                                <label for="board-select">Subject</label>
                                                <select class="teacher-dashboard-input" name="subject_select" id="subject-select" required onchange="ShowChapter(this.value)">
                                                    <option disabled selected>Select Subject</option>

                                                    <?php
                                                    $sql = "SELECT * FROM subjects WHERE board = '$board' AND standard = '$class'";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $subjectName = $row['subjectname'];
                                                    ?>
                                                            <option value="<?php echo $subjectName; ?>"><?php echo $subjectName; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option disabled selected>No Subject Found</option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>

                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox chapter">
                                                <label for="board-select">Chapter</label>
                                                <select class="teacher-dashboard-input" name="chapter_select" id="chapter-select" required onchange="ShowTopics(this.value)">
                                                    <option disabled selected>Select Chapter</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox video">
                                                <label for="board-select">Video</label>
                                                <input type="file" name="video_file" id="video-file" accept=".mp4" required>
                                            </div>
                                        </div>
                                        <div class="teacher-dashboard-subject-upload-video-right-inputs">
                                            <div class="teacher-dashboard-subject-upload-video-textbox title">
                                                <label for="board-select">Topic</label>
                                                <select class="teacher-dashboard-input" name="topic_select" id="topic-select" required>
                                                    <option disabled selected>Select Topic</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox topic">
                                                <label for="video-title">Title</label>
                                                <input type="text" name="video_title" id="video-title" required minlength="8">
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox-description">
                                                <label id="label-for-board-select" for="teacher-description-box">Description</label> <br>
                                                <textarea name="video_desc" id="teacher-description-box" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="teacher-dashboard-subject-upload-video-submit-data">
                                        <div class="teacher-dashboard-subject-upload-video-submit-data-terms">
                                            <input type="checkbox" name="terms_conditns" id="terms-conditns" required><span class="checkmark"></span>
                                            <span>I agree to <a href="#">terms and conditions</a></span>
                                        </div>
                                        <div class="teacher-dashboard-subject-upload-video-submit-data-btns">
                                            <input type="submit" value="Upload" name="upload_videos_btn">
                                            <input type="button" value="Back" onclick="showTechContent('show-subjects');">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="teacher-sub-upload-file" class="teacher-dashboard-subject-upload-file">
                                <div class="teacher-dashboard-subject-upload-video-title">
                                    <h3>Upload File</h3>
                                </div>
                                <form id="fileUpload" action="uploadfiles.php" method="post" enctype="multipart/form-data">
                                    <div class="teacher-dashboard-subject-upload-video-input-data">
                                        <div class="teacher-dashboard-subject-upload-video-left-inputs">
                                            <div class="teacher-dashboard-subject-upload-video-textbox board">
                                                <label for="board-select">Board</label>
                                                <select class="teacher-dashboard-input" name="board_select" id="board-select" required>
                                                    <option disabled selected>Select Board</option>
                                                    <option value="SSC">Maharashtra State Board</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox class">
                                                <label for="board-select">Class</label>
                                                <select class="teacher-dashboard-input" name="class_select" id="class-select" required>
                                                    <option disabled selected>Select Class</option>
                                                    <?php
                                                    $sql = "SELECT * FROM classes WHERE board = '$board' ORDER BY standard";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $standardName = $row['standard'];
                                                    ?>
                                                            <option value="<?php echo $standardName; ?>"><?php echo $standardName; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option disabled selected>No Class Found</option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox subject">
                                                <label for="board-select">Subject</label>
                                                <select class="teacher-dashboard-input" name="subject_select" id="subject-select" required onchange="ShowChapterFile(this.value)">
                                                    <option disabled selected>Select Subject</option>

                                                    <?php
                                                    $sql = "SELECT * FROM subjects WHERE board = '$board' AND standard = '$class'";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $subjectName = $row['subjectname'];
                                                    ?>
                                                            <option value="<?php echo $subjectName; ?>"><?php echo $subjectName; ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option disabled selected>No Subject Found</option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>

                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox chapter">
                                                <label for="board-select">Chapter</label>
                                                <select class="teacher-dashboard-input" name="chapter_select" id="chapter-select-file" required onchange="ShowTopicsFile(this.value)">
                                                    <option disabled selected>Select Chapter</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox video">
                                                <label for="board-select">File</label>
                                                <input type="file" name="pdf_file" id="video-file" accept=".pdf" required>
                                            </div>
                                        </div>
                                        <div class="teacher-dashboard-subject-upload-video-right-inputs">
                                            <div class="teacher-dashboard-subject-upload-video-textbox title">
                                                <label for="board-select">Topic</label>
                                                <select class="teacher-dashboard-input" name="topic_select" id="topic-select-file" required>
                                                    <option disabled selected>Select Topic</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox topic">
                                                <label for="video-title">Title</label>
                                                <input type="text" name="file_title" id="video-title" required minlength="8">
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox-description">
                                                <label id="label-for-board-select" for="teacher-description-box">Description</label> <br>
                                                <textarea name="file_desc" id="teacher-description-box" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="teacher-dashboard-subject-upload-video-submit-data">
                                        <div class="teacher-dashboard-subject-upload-video-submit-data-terms">
                                            <input type="checkbox" name="terms_conditns" id="terms-conditns" required><span class="checkmark"></span>
                                            <span>I agree to <a href="#">terms and conditions</a></span>
                                        </div>
                                        <div class="teacher-dashboard-subject-upload-video-submit-data-btns">
                                            <input type="submit" value="Upload" name="upload_file_btn">
                                            <input type="button" value="Back" onclick="showTechContent('show-subjects');">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="teacher-sub-history" class="teacher-dashboard-subject-history">
                                <!--  History -->
                                <div id="teacher-panel-history" class="teacher-dashboard-history">
                                    <div class="admin-dashboard-manage-user-add-video-and-serch">
                                        <div id="teacher-history-panel-btns" class="admin-dashboard-manage-users-searchbox-add-vid">
                                            <button onclick="ManageHistoryTeacher('showVideoTable')">Videos</button>
                                            <button onclick="ManageHistoryTeacher('showFileTable')">Files</button>
                                        </div>
                                        <div id="admin-dashboard-manage-video-searchbox-dropdwn" class="admin-dashboard-manage-users-searchbox-dropdwn">
                                            <div class="admin-dashboard-manage-users-searchbox-add-vid">
                                                <button onclick="showTechContent('show-subjects');">Back</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="teacher-panel-video-file-history">
                                        <!-- Video History -->
                                        <div id="teacher-dashboard-video-history-table" class="teacher-dashboard-history-table">
                                            <table class="teacher-dashboard-history-table">
                                                <tr>
                                                    <th>Class</th>
                                                    <th>Subject</th>
                                                    <th>Chapter</th>
                                                    <th>Topic</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Upload At</th>
                                                    <th>Views</th>
                                                </tr>
                                                    <?php
                                                        
                                                        $sql = "SELECT * FROM videouploaded WHERE userid = '$userId'";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                $ClassTable = $row['standard'];
                                                                $SubjectTable = $row['subject'];	
                                                                $ChapterTable = $row['chapter'];	
                                                                $TopicTable = $row['topic'];	
                                                                $TitleTable = $row['title'];	
                                                                $DescriptionTable = $row['description'];	
                                                                $Upload_AtTable = $row['uploadtime'];	
                                                                $ViewsTable = $row['views'];


                                                                echo '
                                                                <tr>
                                                                    <td>'.$ClassTable.'</td>
                                                                    <td>'.$SubjectTable.'</td>
                                                                    <td>'.$ChapterTable.'</td>
                                                                    <td>'.$TopicTable.'</td>
                                                                    <td>'.$TitleTable.'</td>
                                                                    <td>'.$DescriptionTable.'</td>
                                                                    <td>'.$Upload_AtTable.'</td>
                                                                    <td>'.$ViewsTable.'</td>
                                                                </tr>
                                                                ';

                                                            }
                                                        }else{
                                                            echo '
                                                            <tr>
                                                                <td colspan="8" style="text-align:center;height:300px;">Sorry,No Data Found! :(</td>
                                                            </tr>
                                                            ';

                                                        }

                                                    ?>
                                            </table>
                                        </div>
                                        <!-- File History -->
                                        <div id="teacher-dashboard-file-history-table" class="teacher-dashboard-history-table">
                                            <table class="teacher-dashboard-history-table">
                                                <tr>
                                                    <th>Class</th>
                                                    <th>Subject</th>
                                                    <th>Chapter</th>
                                                    <th>Topic</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Upload At</th>
                                                    <th>Downloads</th>
                                                </tr>
                                                <?php
                                                        
                                                        $sql = "SELECT * FROM fileuploaded WHERE userid = '$userId'";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                $ClassTable = $row['standard'];
                                                                $SubjectTable = $row['subject'];	
                                                                $ChapterTable = $row['chapter'];	
                                                                $TopicTable = $row['topic'];	
                                                                $TitleTable = $row['title'];	
                                                                $DescriptionTable = $row['description'];	
                                                                $Upload_AtTable = $row['uploadtime'];	
                                                                $ViewsTable = $row['views'];


                                                                echo '
                                                                <tr>
                                                                    <td>'.$ClassTable.'</td>
                                                                    <td>'.$SubjectTable.'</td>
                                                                    <td>'.$ChapterTable.'</td>
                                                                    <td>'.$TopicTable.'</td>
                                                                    <td>'.$TitleTable.'</td>
                                                                    <td>'.$DescriptionTable.'</td>
                                                                    <td>'.$Upload_AtTable.'</td>
                                                                    <td>'.$ViewsTable.'</td>
                                                                </tr>
                                                                ';

                                                            }
                                                        }else{
                                                            echo '
                                                            <tr>
                                                                <td colspan="8" style="text-align:center;height:300px;">Sorry,No Data Found! :(</td>
                                                            </tr>
                                                            ';

                                                        }

                                                    ?>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous"></script>
                <script src="js/ajax.js"></script>
                <script src="js/script.js" defer></script>
                <script src="js/validateForm.js" defer></script>
                <script src="js/hamburger.js" defer></script>
                <script>
                    // For chap no and name
                    jQuery(document).ready(function() {
                        jQuery('.teacher-dashboard-nav-links').click(function(event) {
                            jQuery('.teacher-dashboard-nav-links-active').removeClass('teacher-dashboard-nav-links-active');
                            jQuery(this).addClass('teacher-dashboard-nav-links-active');
                            event.preventDefault();
                        });
                    });
                </script>
            </body>

            </html>

<?php
            if (isset($_SESSION['usererrors'])) {
                if (!$_SESSION['usererrors'] == "") {
                    if ($_SESSION['usererrors'] == "errorOccured") {
                        echo '
                        <div class="client-error-mesg">
                            <p>An Error Occured, Please Try Again</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "suspecious") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Suspecious activity has been detected!</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "AlreadyUploaded") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Video Already Uploaded</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                        unset($_SESSION['Registered']);
                    }

                    if ($_SESSION['usererrors'] == "AlreadyUploadedFile") {
                        echo '
                        <div class="client-error-mesg">
                            <p>File Already Uploaded</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                        unset($_SESSION['Registered']);
                    } 

                    if ($_SESSION['usererrors'] == "Filetoolarge") {
                        echo '
                        <div class="client-error-mesg">
                            <p>File too large. File must be less than 100MB.</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }
                    if ($_SESSION['usererrors'] == "FiletoolargeFile") {
                        echo '
                        <div class="client-error-mesg">
                            <p>File too large. File must be less than 25MB.</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "UploadSuccessVideo") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Yahoo, Video Requested Successfully :)</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                        unset($_SESSION['Registered']);

                    } 

                    if ($_SESSION['usererrors'] == "UploadSuccessFile") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Yahoo, File Requested Successfully :)</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                        unset($_SESSION['Registered']);

                    }

                    if ($_SESSION['usererrors'] == "UploadFailed") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Sorry, Video Request Failed :(</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }
                    if ($_SESSION['usererrors'] == "UploadFileFailed") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Sorry, File Request Failed :(</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "Invalidfileextension") {
                        echo '
                        <div class="client-error-mesg">
                            <p>You have select invalid file!</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "Pleaseselectfile") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Please select a file</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "selecttopic") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Please select a topic</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "selectchapter") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Please select a chapter</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "selectsubject") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Please select a chapter</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "selectclass") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Please select a class</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "selectboard") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Please select a board</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "selectterms") {
                        echo '
                        <div class="client-error-mesg">
                            <p>Please read and accept terms and conditions</p>
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

                    if($_SESSION['usererrors'] == "instructorSuccess"){
                        echo '
                        <div class="client-error-mesg">
                            <p>Congratulation! For becoming Instructor</p>
                        </div>';
                        $_SESSION['usererrors'] = "";
                    }



                    $_SESSION['usererrors'] = "";
                }
                $_SESSION['usererrors'] = "";
            }




            // Below This is isset checking validation of text fields


        } else {
            $_SESSION['loginErrors'] = "nouserfound";
            echo "<script>window.location.replace('index.php');</script>";
        }
    } else {
        $_SESSION['loginErrors'] = "supecious";
        echo "<script>window.location.replace('index.php');</script>";
    }
} else {
    $_SESSION['loginErrors'] = "supecious";
    header('Location: index.php');
}

?>