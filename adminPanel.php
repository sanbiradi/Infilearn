<?php
session_start();
include('dbconnect.php');
if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['loggedin'] == true) {
        if (isset($_SESSION['userid'])) {

            $userId = $_SESSION['userid'];
            $getInfo = false;

            $sql = "SELECT * FROM user_login ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dbUserId = $row['userid'];
                    $dbUsername = $row['name'];
                    // $dbBoard = $row['board'];
                    // $dbClass = $row['standard'];
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
                    // $board = $dbBoard;
                    // $class = $dbClass;
                    $role =  $dbRole;
                    $profileImg = $dbProfileimg;
                    $email = $dbemail;

                    $_SESSION['username'] = $username;
                    // $_SESSION['board'] = $board;
                    // $_SESSION['class'] = $class;
                    $_SESSION['profileImg'] = $profileImg;
                    $_SESSION['email'] = $email;
                    $_SESSION['role_pre'] = $role;

                    if ($role != "Admin") {
                        if ($role == "Student") {
                            echo "<script>window.location.replace('selectSubject.php');</script>";
                        }
                        if ($role == "Teacher") {
                            echo "<script>window.location.replace('teacherSubjectSelection.php');</script>";
                        } else {
                            $_SESSION['loginErrors'] = "noValueReturn";
                            echo "<script>window.location.replace('index.php');</script>";
                        }
                    }
                }
                if ($getInfo == false) {
                    $username = "Username";
                    // $board = "Board";
                    // $class = "Class";
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

                <!-- Section Select subject -->

                <section class="admin-dashboard-section">
                    <div class="admin-dashboard-content-div">
                        <!-- TEACHER Subject navigation Bar -->
                        <div id="admin-dashboard-content-navigation-bar" class="admin-subject-content-navigation-bar">
                            <ul class="admin-dashboard-content-navigation-bar-ul">
                                <li>
                                    <a class="admin-dashboard-nav-links" onclick="showAdminPanelli('manage-analytics');" href="#">
                                        <img src="content/icons/admin/analytics_white_36dp.svg" alt="video upload" height="35px">
                                        <span>Analytics</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="admin-dashboard-nav-links" onclick="showAdminPanelli('manage-user');" href="#">
                                        <img src="content/icons/admin/manage-users.svg" alt="video upload" height="35px">
                                        <span>Manage Users</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="admin-dashboard-nav-links" onclick="showAdminPanelli('manage-video');" href="#">
                                        <img src="content/icons/admin/manage-videos.svg" alt="file upload" height="35px">
                                        <span>Manage Videos</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="admin-dashboard-nav-links" onclick="showAdminPanelli('manage-file');" href="#">
                                        <img src="content/icons/admin/manage-file.svg" alt="history" height="35px">
                                        <span>Manage Files</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="admin-dashboard-nav-links" onclick="showAdminPanelli('manage-syllabus');" href="#">
                                        <img src="content/icons/admin/syllabus.svg" alt="video upload" height="35px">
                                        <span>Manage Syllabus</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="admin-dashboard-nav-links" onclick="showAdminPanelli('manage-req');" href="#">
                                        <img src="content/icons/admin/Request.svg" alt="video upload" height="35px">
                                        <span>Manage Requests</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- teacher Subject content upload panel -->

                        <div id="admin-dashboard-content-all-content" class="admin-dashboard-content-all-content">
                            <!-- Manage USers -->
                            <div id="admin-panel-manage-user" class="admin-dashboard-manage-users">
                                <div class="admin-dashboard-manage-users-searchbox-dropdwn">
                                    <div class="admin-dashboard-search-bar-box">
                                        <input type="text" name="dashboard-search" id="dashboard-search" placeholder="Username / Email">
                                        <input type="button" value="">
                                    </div>
                                    <div class="admin-dashboard-dropdwn-menu">
                                        <select name="users" id="manage-user-select" onchange="ManageUsers();">
                                            <option selected disabled>Select</option>
                                            <option value="all-users">All users</option>
                                            <option value="blocked-users">Blocked users</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="teacher-dashboard-subject-upload-video-title">
                                    <h3>User Details</h3>
                                </div>
                                <!-- All USers -->
                                <div id="manage-user-all-user" class="admin-dashboard-manage-user-table">
                                    <table class="admin-dashboard-manage-user-table-table" id="manage-user-all-user-table">
                                        


                                    </table>
                                </div>
                                <!-- Block Users0 -->
                                <div id="manage-user-blocked-user" class="admin-dashboard-manage-user-table">
                                    <table class="admin-dashboard-manage-user-table-table" id="manage-user-blocked-user-table">
                                        

                                    </table>
                                </div>
                            </div>
                            <!-- Manage Videos -->
                            <div id="admin-panel-manage-video" class="admin-dashboard-manage-users">
                                <div class="admin-dashboard-manage-user-add-video-and-serch">
                                    <div class="admin-dashboard-manage-users-searchbox-add-vid">
                                        <button onclick="showAdminPanelli('upload-vid');">Add Video</button>
                                    </div>
                                    <div id="admin-dashboard-manage-video-searchbox-dropdwn" class="admin-dashboard-manage-users-searchbox-dropdwn">
                                        <div class="admin-dashboard-search-bar-box">
                                            <input type="text" name="dashboard-search" id="dashboard-search" placeholder="Creator / Title / Subject">
                                            <input type="button" value="">
                                        </div>
                                        <!-- <div class="admin-dashboard-dropdwn-menu">
                                <select name="users" id="">
                                    <option selected disabled value="">Select</option>
                                    <option value="all-users">All users</option>
                                    <option value="blocked-users">Blocked users</option>
                                </select>
                            </div> -->
                                    </div>
                                </div>

                                <div class="teacher-dashboard-subject-upload-video-title">
                                    <h3>Video Details</h3>
                                </div>
                                <div class="admin-dashboard-manage-user-table">
                                    <table class="admin-dashboard-manage-user-table-table">
                                        <tr>
                                            <th>Board</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Chapter</th>
                                            <th>Topic</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Created By</th>
                                            
                                            <th>Upload Time</th>
                                            <th>Views</th>
                                            <th>Action</th>
                                        </tr>

                                        <?php

                                        $sql = "SELECT * FROM videouploaded ORDER BY uploadtime DESC";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $BoardTable = $row['board'];
                                                $ClassTable = $row['standard'];
                                                $SubjectTable = $row['subject'];
                                                $ChapterTable = $row['chapter'];
                                                $TopicTable = $row['topic'];
                                                $TitleTable = $row['title'];
                                                $DescriptionTable = $row['description'];
                                                $Upload_AtTable = $row['uploadtime'];
                                                $createdTable =  $row['email'];
                                                $createdEmailTable =  $row['email'];
                                                $ViewsTable = $row['views'];
                                                $video_uploaded_id = $row['id'];


                                                echo '
                                                                <tr>
                                                                    <td>' . $BoardTable . '</td>
                                                                    <td>' . $ClassTable . '</td>
                                                                    <td>' . $SubjectTable . '</td>
                                                                    <td>' . $ChapterTable . '</td>
                                                                    <td>' . $TopicTable . '</td>
                                                                    <td>' . $TitleTable . '</td>
                                                                    <td>' . $DescriptionTable . '</td>
                                                                    <td>' . $createdTable . '</td>
                                                                    
                                                                    <td>' . $Upload_AtTable . '</td>
                                                                    <td>' . $ViewsTable . '</td>
                                                                    <td class="admin-table-action-btns-manage-video">
                                                                        <button onclick="EditVideo(' . $video_uploaded_id . ')">
                                                                            <img src="content/icons/admin/Edit.svg" alt="edit action" height="15px">
                                                                        </button>
                                                                        <button onclick="RemoveVideo(' . $video_uploaded_id . ')">
                                                                            <img src="content/icons/admin/remove.svg" alt="remove action" height="15px">
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                ';
                                            }
                                        } else {
                                            echo '
                                                            <tr>
                                                                <td colspan="12" style="text-align:center;height:300px;">Sorry,No Data Found! :(</td>
                                                            </tr>
                                                            ';
                                        }

                                        ?>

                                    </table>
                                </div>
                            </div>
                            <!-- Manage Files -->
                            <div id="admin-panel-manage-file" class="admin-dashboard-manage-users">
                                <div class="admin-dashboard-manage-user-add-video-and-serch">
                                    <div class="admin-dashboard-manage-users-searchbox-add-vid">
                                        <button onclick="showAdminPanelli('upload-file');">Add File</button>
                                    </div>
                                    <div id="admin-dashboard-manage-video-searchbox-dropdwn" class="admin-dashboard-manage-users-searchbox-dropdwn">
                                        <div class="admin-dashboard-search-bar-box">
                                            <input type="text" name="dashboard-search" id="dashboard-search" placeholder="Creator / Title / Subject">
                                            <input type="button" value="">
                                        </div>
                                        <!-- <div class="admin-dashboard-dropdwn-menu">
                                <select name="users" id="">
                                    <option selected disabled value="">Select</option>
                                    <option value="all-users">All users</option>
                                    <option value="blocked-users">Blocked users</option>
                                </select>
                            </div> -->
                                    </div>
                                </div>

                                <div class="teacher-dashboard-subject-upload-video-title">
                                    <h3>File Details</h3>
                                </div>
                                <div class="admin-dashboard-manage-user-table">
                                    <table class="admin-dashboard-manage-user-table-table">
                                        <tr>
                                            <th>Board</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Chapter</th>
                                            <th>Topic</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Created By</th>
                                            
                                            <th>Upload Time</th>
                                            <th>Downloads</th>
                                            <th>Action</th>
                                        </tr>

                                        <?php

                                        $sql = "SELECT * FROM fileuploaded ORDER BY uploadtime DESC";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $BoardTable = $row['board'];
                                                $ClassTable = $row['standard'];
                                                $SubjectTable = $row['subject'];
                                                $ChapterTable = $row['chapter'];
                                                $TopicTable = $row['topic'];
                                                $TitleTable = $row['title'];
                                                $DescriptionTable = $row['description'];
                                                $Upload_AtTable = $row['uploadtime'];
                                                $createdTable =  $row['email'];
                                                $createdEmailTable =  $row['email'];
                                                $ViewsTable = $row['views'];
                                                $file_uploaded_id = $row['id'];


                                                echo '
                                                                <tr>
                                                                    <td>' . $BoardTable . '</td>
                                                                    <td>' . $ClassTable . '</td>
                                                                    <td>' . $SubjectTable . '</td>
                                                                    <td>' . $ChapterTable . '</td>
                                                                    <td>' . $TopicTable . '</td>
                                                                    <td>' . $TitleTable . '</td>
                                                                    <td>' . $DescriptionTable . '</td>
                                                                    <td>' . $createdTable . '</td>
                                                                    
                                                                    <td>' . $Upload_AtTable . '</td>
                                                                    <td>' . $ViewsTable . '</td>
                                                                    <td class="admin-table-action-btns-manage-video"> 
                                                                        <button onclick="EditFile(' . $file_uploaded_id . ')">
                                                                            <img src="content/icons/admin/Edit.svg" alt="edit action" height="15px">
                                                                        </button>
                                                                        <button onclick="RemoveVideo(' . $file_uploaded_id . ')">
                                                                            <img src="content/icons/admin/remove.svg" alt="remove action" height="15px">
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                ';
                                            }
                                        } else {
                                            echo '
                                                            <tr>
                                                                <td colspan="12" style="text-align:center;height:300px;">Sorry,No Data Found! :(</td>
                                                            </tr>
                                                            ';
                                        }

                                        ?>

                                    </table>
                                </div>
                            </div>
                            <!-- Syllabus -->
                            <div id="admin-panel-manage-syllabus" class="admin-dashboard-manage-users">
                                <div class="admin-panel-manage-syllabus-show-syllabus-btn-and-drpdwn">
                                    <div class="admin-panel-manage-syllabus-show-syllabus-btn">
                                        <button onclick="showSyllabusContent('show-syllabus');">Show Syllabus</button>
                                    </div>
                                    <div class="admin-panel-manage-syllabus-show-syllabus-drpdwn">
                                        <select name="add-content" id="syllabus-content" onchange="showSyllabusContentlist();">
                                            <option selected disabled>Select</option>
                                            <option value="add-board">Add Board</option>
                                            <option value="add-class">Add Class</option>
                                            <option value="add-subject">Add Subject</option>
                                            <option value="add-chapter">Add Chapter</option>
                                            <option value="add-desc">Add Chapter Description</option>
                                            <option value="add-topic">Add Topic</option>
                                            <!-- <option value="add-title">Add Title</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="admin-panel-syllabus-all-contents">
                                    <!-- Show Syllabus -->
                                    <div id="admin-panel-syllabus-show-syllabus" class="admin-panel-syllabus-content">
                                        <div class="acc-container">
                                        <?php 
                                              $sql = "SELECT * FROM subjects WHERE board = 'SSC' ";
                                              $result = $conn->query($sql);
                                              if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $standard_name_sub_t = $row['standard'];
                                                    $subject_name_sub_t = $row['subjectname'];
                                                    ?>
                                                    <div class="acc-btn">
                                                        <h3><?php echo $subject_name_sub_t .' - '.$standard_name_sub_t.' Standard'; ?></h3>
                                                    </div>
                                                    <div class="acc-content">
                                                        <?php
                                                        $sql_c = "SELECT * FROM chapters WHERE board = 'SSC' AND standard = '$standard_name_sub_t' AND subjectname = '$subject_name_sub_t' ";
                                                        $result_c = $conn->query($sql_c);
                                                        if ($result_c->num_rows > 0) {
                                                          while ($row_c = $result_c->fetch_assoc()) {
                                                              $chapter_name_sub_t = $row_c['chaptername'];
                                                               ?>
                                                        <div class="acc-two-btn">
                                                            <h3><?php echo $chapter_name_sub_t; ?></h3>
                                                        </div>
                                                        <div class="acc-two-content">
                                                        <?php
                                                        $sql_t = "SELECT * FROM topics WHERE board = 'SSC' AND class = '$standard_name_sub_t' AND subjectname = '$subject_name_sub_t' AND chaptername = '$chapter_name_sub_t' ";
                                                        $result_t = $conn->query($sql_t);
                                                        if ($result_t->num_rows > 0) {
                                                          while ($row_t = $result_t->fetch_assoc()) {
                                                              $topic_name_sub_t = $row_t['topicname'];
                                                               ?>
                                                            <div class="acc-three-btn">
                                                                <h3><?php echo $topic_name_sub_t; ?></h3>
                                                            </div>
                                                            <div class="acc-three-content">
                                                            <?php
                                                                $sql_v = "SELECT * FROM videouploaded WHERE board = 'SSC' AND standard = '$standard_name_sub_t' AND subject = '$subject_name_sub_t' AND chapter = '$chapter_name_sub_t' AND topic = '$topic_name_sub_t'";
                                                                $result_v = $conn->query($sql_v);
                                                                if ($result_v->num_rows > 0) {
                                                                while ($row_v = $result_v->fetch_assoc()) {
                                                                    $video_title_sub_t = $row_v['title'];
                                                                    ?>
                                                                <p><?php echo $video_title_sub_t; ?></p>
                                                                <?php 
                                                                }
                                                            }else{
                                                                ?>
                                                                    <h3>No Video Available</h3>
                                                                <?php
                                                            }
                                                                ?>
                                                            </div>
                                                            <?php
                                                          }
                                                        }else{
                                                            ?>
                                                                <h3>No Topics Available</h3>
                                                            <?php
                                                        } 
                                                            ?>
                                                        </div>
                                                        <?php 
                                                          }
                                                        }else{
                                                            ?>
                                                                <h3>No Chapters Available</h3>
                                                            <?php
                                                        }   
                                                        ?>
                                                    </div>
                                            <?php
                                                        
                                                }   
                                            }else{
                                                ?>
                                                    <h3>No Class Available</h3>
                                                <?php
                                            }   
                                        ?>
                                            

                                            
                                        </div>
                                    </div>
                                    <!-- Add Board -->
                                    <div id="admin-panel-syllabus-add-board" class="admin-panel-syllabus-content-inputs">
                                        <div class="admin-panel-syllabus-input-content">
                                            <form action="addBoard.php" method="post">
                                                <div class="admin-panel-syllabus-input-content-text">
                                                    <input type="text" name="Board_txt" placeholder="Add Board" required>
                                                </div>
                                                <div class="admin-panel-syllabus-input-content-submit">
                                                    <button type="submit" name="addBoard_btn">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Add Class -->
                                    <div id="admin-panel-syllabus-add-class" class="admin-panel-syllabus-content-inputs">
                                        <div class="admin-panel-syllabus-input-content">
                                            <form action="addClass.php" method="post">
                                                <div class="admin-panel-syllabus-input-content-select">
                                                    <select name="select_board_dropdown" id="select-board">
                                                        <option selected disabled>Select Board</option>
                                                        <?php
                                                        $sql = "SELECT * FROM boards";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                $board =  $row['name'];
                                                        ?>
                                                                <option value="<?php echo $board ?>"><?php echo $board ?></option>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                                <br>
                                                <div class="admin-panel-syllabus-input-content-text">
                                                    <input type="text" name="class_name" placeholder="Add Class" required>
                                                </div>
                                                <div class="admin-panel-syllabus-input-content-submit">
                                                    <button type="submit" name="class_submit_btn">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Add Subject -->
                                    <div id="admin-panel-syllabus-add-subject" class="admin-panel-syllabus-content-inputs">
                                        <div class="admin-panel-syllabus-input-content">
                                            <form action="addSubject.php" method="post">
                                                <div class="admin-panel-syllabus-input-content-select">
                                                    <select name="select_board_dropdown" id="select-board-syllabus-subject" onchange="ShowClassSyllabus(this.value)" required>
                                                        <option selected disabled>Select Board</option>
                                                        <?php
                                                        $sql = "SELECT * FROM boards";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                $board =  $row['name'];
                                                        ?>
                                                                <option value="<?php echo $board ?>"><?php echo $board ?></option>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                    <select name="select_class_dropdown" id="select-class-syllabus-subject" required>
                                                        <option selected disabled>Select Class</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <div class="admin-panel-syllabus-input-content-text">
                                                    <input type="text" name="subject_name" placeholder="Add Subject" required>
                                                </div>
                                                <div class="admin-panel-syllabus-input-content-submit">
                                                    <button type="submit" name="subject_submit_btn">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Add Chapter -->
                                    <div id="admin-panel-syllabus-add-chapter" class="admin-panel-syllabus-content-inputs">
                                        <div class="admin-panel-syllabus-input-content">
                                            <form action="addChapter.php" method="post">
                                                <div class="admin-panel-syllabus-input-content-select">
                                                    <select name="select_board_dropdown" id="select-board-syllabus-chapter" onchange="ShowClassSyllabusChapter(this.value)" required>
                                                        <option selected disabled>Select Board</option>
                                                        <?php
                                                        $sql = "SELECT * FROM boards";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                $board =  $row['name'];
                                                        ?>
                                                                <option value="<?php echo $board ?>"><?php echo $board ?></option>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                    <select name="select_class_dropdown" id="select-class-syllabus-chapter" onchange="ShowSubjectSyllabusChapter(this.value)" required>
                                                        <option selected disabled>Select Class</option>
                                                    </select>
                                                    <select name="select_subject_dropdown" id="select-subject-syllabus-chapter" required>
                                                        <option selected disabled>Select Subject</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <div class="admin-panel-syllabus-input-content-text">
                                                    <input type="text" name="chapter_name" placeholder="Add Chapter" required>
                                                </div>
                                                <div class="admin-panel-syllabus-input-content-submit">
                                                    <button type="submit" name="chapter_submit_btn">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Add Topic -->
                                    <div id="admin-panel-syllabus-add-topic" class="admin-panel-syllabus-content-inputs">
                                        <div class="admin-panel-syllabus-input-content">
                                            <form action="addTopic.php" method="post">
                                                <div class="admin-panel-syllabus-input-content-select">
                                                    <select name="select_board_dropdown" id="select-board-syllabus-topic" onchange="ShowClassSyllabusTopic(this.value)" required>
                                                        <option selected disabled>Select Board</option>
                                                        <?php
                                                        $sql = "SELECT * FROM boards";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                $board =  $row['name'];
                                                        ?>
                                                                <option value="<?php echo $board ?>"><?php echo $board ?></option>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                    <select name="select_class_dropdown" id="select-class-syllabus-topic" onchange="ShowSubjectSyllabusTopic(this.value)" required>
                                                        <option selected disabled>Select Class</option>
                                                    </select>
                                                    <select name="select_subject_dropdown" id="select-subject-syllabus-topic" onchange="ShowChapterSyllabusTopic(this.value)" required>
                                                        <option selected disabled>Select Subject</option>
                                                    </select>
                                                    <select name="select_chapter_dropdown" id="select-chapter-syllabus-topic" required>
                                                        <option selected disabled>Select Chapter</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <div class="admin-panel-syllabus-input-content-text">
                                                    <input type="text" name="topic_name" placeholder="Add Topic" required>
                                                </div>
                                                <div class="admin-panel-syllabus-input-content-submit">
                                                    <button type="submit" name="topic_submit_btn">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Add Description -->
                                    <div id="admin-panel-syllabus-add-descs" class="admin-panel-syllabus-content-inputs">
                                        <div class="admin-panel-syllabus-input-content">
                                            <form action="addDescription.php" method="post">
                                                <div class="admin-panel-syllabus-input-content-select">
                                                    <select name="select_board_dropdown" id="select-board-syllabus-desc" onchange="ShowClassSyllabusDesc(this.value)" required>
                                                        <option selected disabled>Select Board</option>
                                                        <?php
                                                        $sql = "SELECT * FROM boards";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                $board =  $row['name'];
                                                        ?>
                                                                <option value="<?php echo $board ?>"><?php echo $board ?></option>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                    <select name="select_class_dropdown" id="select-class-syllabus-desc" onchange="ShowSubjectSyllabusDesc(this.value)" required>
                                                        <option selected disabled>Select Class</option>
                                                    </select>
                                                    <select name="select_subject_dropdown" id="select-subject-syllabus-desc" onchange="ShowChapterSyllabusDesc(this.value)" required>
                                                        <option selected disabled>Select Subject</option>
                                                    </select>
                                                    <select name="select_chapter_dropdown" id="select-chapter-syllabus-desc" required>
                                                        <option selected disabled>Select Chapter</option>
                                                    </select>

                                                </div>
                                                <br>
                                                <div class="admin-panel-syllabus-input-content-text">
                                                    <!-- <input id="admin-panel-syllabus-input-content-text-desc" type="text" placeholder="Add Chapter Description"> -->
                                                    <textarea id="admin-panel-syllabus-input-content-text-desc" name="chapter_desc" cols="30" rows="10" placeholder="Add Chapter Description"></textarea>
                                                </div>
                                                <div class="admin-panel-syllabus-input-content-submit">
                                                    <button type="submit" name="desc_submit_btn">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Manage Request -->
                            <div id="admin-panel-manage-request" class="admin-dashboard-manage-users">
                                <div id="admin-dashboard-manage-video-searchbox-dropdwn" class="admin-dashboard-manage-users-searchbox-dropdwn">
                                    <div class="admin-dashboard-search-bar-box">
                                        <input type="text" name="dashboard-search" id="dashboard-search" placeholder="Username">
                                        <input type="button" value="">
                                    </div>
                                    <div class="admin-dashboard-dropdwn-menu">
                                        <!-- <select name="users" id="">
                                    <option selected disabled value="">Select</option>
                                    <option value="all-users">All users</option>
                                    <option value="blocked-users">Blocked users</option>
                                </select> -->
                                    </div>
                                </div>
                                <div class="teacher-dashboard-subject-upload-video-title">
                                    <h3>Upload Requests</h3>
                                </div>
                                <div class="admin-dashboard-manage-user-table">
                                    <table class="admin-dashboard-manage-user-table-table" id="admin-request-get-data-table">
                                        

                                    </table>
                                </div>
                            </div>
                            <!-- Analytics -->
                            <div id="admin-panel-manage-analytics" class="admin-dashboard-manage-users">
                                <div class="admin-panel-all-analytics">
                                    <div class="admin-panel-first-four">
                                        <!-- Users -->
                                        <div class="admin-panel-single-analytic">
                                            <div id="analytic-img-users" class="admin-panel-analytic-img">
                                                <!-- img here -->
                                            </div>
                                            <div class="admin-panel-analytic-data">
                                                <?php
                                                    $sql_req = "SELECT * FROM user_login ";
                                                    $result = $conn->query($sql_req);
                                                    if ($result->num_rows > 0) {
                                                        $i = 0;
                                                        while ($row = $result->fetch_assoc()) {
                                                            $i++;
                                                        }
                                                    ?>
                                                    <h3><?php echo $i; ?></h3><?php
                                                                                    
                                                }else{
                                                    ?><h3><?php echo '0'; ?></h3><?php
                                                }

                                                ?>

                                                <h5>Users</h5>
                                            </div>
                                        </div>
                                        <!-- teachers -->
                                        <div class="admin-panel-single-analytic">
                                            <div id="analytic-img-teachers" class="admin-panel-analytic-img">
                                                <!-- img here -->
                                            </div>
                                            <div class="admin-panel-analytic-data">
                                                <?php
                                                    $sql_req = "SELECT * FROM user_login WHERE role = 'Teacher'";
                                                    $result = $conn->query($sql_req);
                                                    if ($result->num_rows > 0) {
                                                        $i = 0;
                                                        while ($row = $result->fetch_assoc()) {
                                                            $i++;
                                                        }
                                                    ?>
                                                    <h3><?php echo $i; ?></h3><?php
                                                                                    
                                                }else{
                                                    ?><h3><?php echo '0'; ?></h3><?php
                                                }

                                                ?>
                                                <h5>Teachers</h5>
                                            </div>
                                        </div>
                                        <!-- students -->
                                        <div class="admin-panel-single-analytic">
                                            <div id="analytic-img-students" class="admin-panel-analytic-img">
                                                <!-- img here -->
                                            </div>
                                            <div class="admin-panel-analytic-data">
                                                <?php
                                                    $sql_req = "SELECT * FROM user_login WHERE role = 'Student'";
                                                    $result = $conn->query($sql_req);
                                                    if ($result->num_rows > 0) {
                                                        $i = 0;
                                                        while ($row = $result->fetch_assoc()) {
                                                            $i++;
                                                        }
                                                    ?>
                                                    <h3><?php echo $i; ?></h3><?php
                                                                                    
                                                }else{
                                                    ?><h3><?php echo '0'; ?></h3><?php
                                                }

                                                ?>
                                                <h5>Students</h5>
                                            </div>
                                        </div>
                                        <!-- visits -->
                                        <div class="admin-panel-single-analytic">
                                            <div id="analytic-img-visits" class="admin-panel-analytic-img">
                                                <!-- img here -->
                                            </div>
                                            <div class="admin-panel-analytic-data">
                                                <?php
                                                    $sql_req = "SELECT * FROM analytics WHERE id = '1'";
                                                    $result = $conn->query($sql_req);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $views = $row['views'];
                                                        }
                                                    ?>
                                                    <h3><?php echo $views; ?></h3><?php
                                                                                    
                                                }else{
                                                    ?><h3><?php echo '0'; ?></h3><?php
                                                }

                                                ?>
                                                <h5>Visits</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="admin-panel-middle-two">
                                        <!-- videos -->
                                        <div class="admin-panel-single-analytic">
                                            <div id="analytic-img-videos" class="admin-panel-analytic-img">
                                                <!-- img here -->
                                            </div>
                                            <div class="admin-panel-analytic-data">
                                            <?php
                                                    $sql_req = "SELECT * FROM videouploaded";
                                                    $result = $conn->query($sql_req);
                                                    if ($result->num_rows > 0) {
                                                        $i = 0;
                                                        while ($row = $result->fetch_assoc()) {
                                                            $i++;
                                                        }
                                                    ?>
                                                    <h3><?php echo $i; ?></h3><?php
                                                    
                                                }else{
                                                    ?><h3><?php echo '0'; ?></h3><?php
                                                }

                                                ?>
                                                <h5>Videos</h5>
                                            </div>
                                        </div>
                                        <!-- files -->
                                        <div class="admin-panel-single-analytic">
                                            <div id="analytic-img-files" class="admin-panel-analytic-img">
                                                <!-- img here -->
                                            </div>
                                            <div class="admin-panel-analytic-data">
                                            <?php
                                                    $sql_req = "SELECT * FROM fileuploaded";
                                                    $result = $conn->query($sql_req);
                                                    if ($result->num_rows > 0) {
                                                        $i = 0;
                                                        while ($row = $result->fetch_assoc()) {
                                                            $i++;
                                                        }
                                                    ?>
                                                    <h3><?php echo $i; ?></h3><?php
                                                                                    
                                                }else{
                                                    ?><h3><?php echo '0'; ?></h3><?php
                                                }

                                                ?>
                                                <h5>Files</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="admin-panel-last-one">
                                        <!-- BLocked Users -->
                                        <div class="admin-panel-single-analytic">
                                            <div id="analytic-img-block-user" class="admin-panel-analytic-img">
                                                <!-- img here -->
                                            </div>
                                            <div class="admin-panel-analytic-data">
                                            <?php
                                                    $sql_req = "SELECT * FROM user_login";
                                                    $result = $conn->query($sql_req);
                                                    if ($result->num_rows > 0) {
                                                        $i = 0;
                                                        while ($row = $result->fetch_assoc()) {
                                                            if($row['isblocked'] == 'true'){
                                                                $i++;
                                                            }
                                                        }
                                                    ?>
                                                    <h3><?php echo $i; ?></h3><?php
                                                                                    
                                                }else{
                                                    ?><h3><?php echo '0'; ?></h3><?php
                                                }

                                                ?>
                                                <h5>Blocked</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Upload Video -->
                            <div id="admin-sub-upload-vid" class="admin-dashboard-subject-upload-video">

                                <div class="teacher-dashboard-subject-upload-video-title">
                                    <h3>Upload Video</h3>
                                </div>
                                <form id="videoUploadAdmin" action="uploadvideoadmin.php" method="post" enctype="multipart/form-data">
                                    <div class="teacher-dashboard-subject-upload-video-input-data">
                                        <div class="teacher-dashboard-subject-upload-video-left-inputs">
                                            <div class="teacher-dashboard-subject-upload-video-textbox board">
                                                <label for="board-select">Board</label>
                                                <select class="teacher-dashboard-input" name="board_select" id="board-select" required onchange="ShowClass(this.value)">
                                                    <option disabled selected>Select Board</option>
                                                    <option value="SSC">Maharashtra State Board</option>
                                                    <option value="ICSE">ICSE</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox class">
                                                <label for="board-select">Class</label>
                                                <select class="teacher-dashboard-input" name="class_select" id="class-select" required onchange="ShowSubject(this.value)">
                                                    <option disabled selected>Select Class</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox subject">
                                                <label for="board-select">Subject</label>
                                                <select class="teacher-dashboard-input" name="subject_select" id="subject-select" required onchange="ShowChapter(this.value)">
                                                    <option disabled selected>Select Subject</option>
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
                                            <div class="teacher-dashboard-subject-upload-video-textbox video">
                                                <label for="board-select">Thumbnail</label>
                                                <input type="file" name="thumbnail_file" id="thumbnail-file" accept=".png" required>
                                            </div>
                                            <a target="_blank" rel="noopener noreferrer" href="thumbnails.php" style="text-decoration: none;cursor:pointer;color:#fe4a55;font-size:16px;font-family:'Nunito';">
                                                &nbsp; Get Thumbnail
                                            </a>
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
                                            <div class="teacher-dashboard-subject-upload-video-textbox topic">
                                                <label for="author-name">Author Name</label>
                                                <input type="text" name="author_name" id="author-name" required >
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox-description">
                                                <label id="label-for-board-select" for="teacher-description-box">Description</label> <br>
                                                <textarea name="video_desc" id="teacher-description-box" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="teacher-dashboard-subject-upload-video-submit-data">
                                        <div class="teacher-dashboard-subject-upload-video-submit-data-btns">
                                            <input type="submit" value="Upload" name="upload_videos_btn">
                                            <input type="button" value="Back" onclick="showAdminPanelli('manage-video')">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Upload FIle -->
                            <div id="admin-sub-upload-file" class="admin-dashboard-subject-upload-file">
                                <div class="teacher-dashboard-subject-upload-video-title">
                                    <h3>Upload File</h3>
                                </div>
                                <form id="videoFileAdmin" action="uploadfileadmin.php" method="POST" enctype="multipart/form-data">
                                    <div class="teacher-dashboard-subject-upload-video-input-data">
                                        <div class="teacher-dashboard-subject-upload-video-left-inputs">
                                            <div class="teacher-dashboard-subject-upload-video-textbox board">
                                                <label for="board-select">Board</label>
                                                <select class="teacher-dashboard-input" name="board_select" id="board-select" required onchange="ShowClassFile(this.value)">
                                                    <option disabled selected>Select Board</option>
                                                    <option value="SSC">Maharashtra State Board</option>
                                                    <option value="ICSE">ICSE</option>
                                                </select>
                                            </div>

                                            <div class="teacher-dashboard-subject-upload-video-textbox class">
                                                <label for="class-select-file">Class</label>
                                                <select class="teacher-dashboard-input" name="class_select" id="class-select-file" required onchange="ShowSubjectFile(this.value)">
                                                    <option disabled selected>Select Class</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox subject">
                                                <label for="subject-select-file">Subject</label>
                                                <select class="teacher-dashboard-input" name="subject_select" id="subject-select-file" required onchange="ShowChapterFiles(this.value)">
                                                    <option disabled selected>Select Subject</option>
                                                </select>

                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox chapter">
                                                <label for="subject-select-file">Chapter</label>
                                                <select class="teacher-dashboard-input" name="chapter_select" id="chapter-select-file" required onchange="ShowTopicsFiles(this.value)">
                                                    <option disabled selected>Select Chapter</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox video">
                                                <label for="pdf-file">File</label>
                                                <input type="file" name="video_file" id="pdf-file" accept=".pdf" required>
                                            </div>
                                        </div>
                                        <div class="teacher-dashboard-subject-upload-video-right-inputs">
                                            <div class="teacher-dashboard-subject-upload-video-textbox title">
                                                <label for="topic-select-file">Topic</label>
                                                <select class="teacher-dashboard-input" name="topic_select" id="topic-select-file" required>
                                                    <option disabled selected>Select Topic</option>
                                                </select>
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox topic">
                                                <label for="file-title">Title</label>
                                                <input type="text" name="video_title" id="file-title" required minlength="8">
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox topic">
                                                <label for="author-name">Author Name</label>
                                                <input type="text" name="author_name" id="author-name" required >
                                            </div>
                                            <div class="teacher-dashboard-subject-upload-video-textbox-description">
                                                <label id="label-for-board-select" for="teacher-description-box">Description</label> <br>
                                                <textarea name="video_desc" id="teacher-description-box" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="teacher-dashboard-subject-upload-video-submit-data">
                                        <div class="teacher-dashboard-subject-upload-video-submit-data-btns">
                                            <input type="submit" value="Upload" name="upload_videos_btn">
                                            <input type="button" value="Back" onclick="showAdminPanelli('manage-file')">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous"></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

                <script src="js/script.js"></script>
                <script src="js/fetchData.js"></script>
                <script src="js/ajax.js"></script>
                <script src="js/validateForm.js"></script>
                <script src="js/adminAjax.js"></script>
                <script src="js/addData.js"></script>
                <script src="js/updateData.js"></script>
                



                <script>
                UpdateDatabase();
                    // For chap no and name
                    jQuery(document).ready(function() {
                        jQuery('.admin-dashboard-nav-links').click(function(event) {
                            jQuery('.admin-dashboard-nav-links-active').removeClass('admin-dashboard-nav-links-active');
                            jQuery(this).addClass('admin-dashboard-nav-links-active');
                            event.preventDefault();
                        });
                    });

                    
                    // Collapsible Main
                    $('.acc-btn').click(function() {
                        if ($(this).next().is(":hidden")) {
                            $('.acc-content').slideUp('selected');
                            $(this).next().slideDown('selected');
                        } else {
                            $(this).next().slideUp('selected');
                        };
                    });

                    // For Chapters
                    $('.acc-two-btn').click(function() {
                        if ($(this).next().is(":hidden")) {
                            $('.acc-two-content').slideUp('selected');
                            $(this).next().slideDown('selected');
                        } else {
                            $(this).next().slideUp('selected');
                        };
                    });

                    // For Topics
                    $('.acc-three-btn').click(function() {
                        if ($(this).next().is(":hidden")) {
                            $('.acc-three-content').slideUp('selected');
                            $(this).next().slideDown('selected');
                        } else {
                            $(this).next().slideUp('selected');
                        };
                    });


                    function UpdateDatabase() {
                        setTimeout( function()  {
                            manageuserallusertable(); 
                            manageuserblockedusertable();
                            adminrequestgetdatatable();
                            UpdateDatabase();
                        }, 200);
                    }
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
                                    <p>Yahoo, Video Uploaded Successfully :)</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                        unset($_SESSION['Registered']);
                    }

                    if ($_SESSION['usererrors'] == "UploadSuccessFile") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Yahoo, File Uploaded Successfully :)</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                        unset($_SESSION['Registered']);
                    }

                    if ($_SESSION['usererrors'] == "UploadFailed") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Sorry, Video Upload Failed :(</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }
                    if ($_SESSION['usererrors'] == "UploadFileFailed") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Sorry, File Upload Failed :(</p>
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

                    if ($_SESSION['usererrors'] == "PleaseselectPoster") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Please select a Thumbnail Image</p>
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

                    // ADD Board

                    if ($_SESSION['usererrors'] == "syllabusUploaded") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Yahoo Syllabus Uploaed Successfully :)</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }
                    if ($_SESSION['usererrors'] == "syllabusUploadedFailed") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Oopss Syllabus Upload Failed :(</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }
                    if ($_SESSION['usererrors'] == "BoardTextNull") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Please Enter Board Name!</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }


                    // ADD Class


                    if ($_SESSION['usererrors'] == "BoardSelectNull") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Please Select Board!</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }
                    if ($_SESSION['usererrors'] == "ClassTextNull") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Please Enter Class Name!</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }


                    // ADD Subject

                    if ($_SESSION['usererrors'] == "ClassSelectNull") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Please Select Class!</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }
                    if ($_SESSION['usererrors'] == "SubjectTextNull") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Please Enter Subject Name!</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    // ADD Chapter

                    if ($_SESSION['usererrors'] == "SubjectSelectNull") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Please Select Subject!</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }
                    if ($_SESSION['usererrors'] == "ChapterTextNull") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Please Enter Chapter Name!</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }



                    // ADD Chapter

                    if ($_SESSION['usererrors'] == "chapterSelectNull") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Please Select Chapter!</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }
                    if ($_SESSION['usererrors'] == "DescTextNull") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Please Enter Description!</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }


                    // Data Updated

                    if ($_SESSION['usererrors'] == "DataUpdated") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Data Uploaded Successfully :)</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }

                    if ($_SESSION['usererrors'] == "DataUpdatedFailed") {
                        echo '
                                <div class="client-error-mesg">
                                    <p>Data Uploaded Failed :(</p>
                                </div>';
                        $_SESSION['usererrors'] = "";
                    }


                    // After Action

                    if ($_SESSION['usererrors'] == "manageUser") {
                        echo '<script>showAdminPanelli("manage-user");</script>';
                        echo "<script>window.location.reload();</script>";
                        $_SESSION['usererrors'] = "";
                    }

                    



                    $_SESSION['usererrors'] = "";
                }
                $_SESSION['usererrors'] = "";
            }















            //  This is Main Else Statement For Checking user after login

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