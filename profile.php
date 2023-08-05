<?php
session_start();
include('dbconnect.php');
if (isset($_SESSION['loggedin'])) {
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
                $dbEmail =  $row['email'];
                $dbGender =  $row['gender'];
                $dbCity = $row['city'];
                $dbDob = $row['dob'];
                $dbPhone = $row['phone'];
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
                $email = $dbEmail;
                $gender = $dbGender;
                $city = $dbCity;
                $dob = $dbDob;
                $phone = $dbPhone;

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
            }
            if ($getInfo == false) {
                $_SESSION['usererrors'] = "errorOccured";
                echo "<script>window.location.replace('selectSubject.php');</script>";
            }
        }

?>

        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="theme-color" content="#fe4a55">
            <title>Profile | Infilearn</title>
            <link rel="stylesheet" href="css/profile.css">
            <link rel="stylesheet" href="css/style.css">
            <script src="js/script.js" defer></script>
            <link rel="icon" href="content/logo/LinkLogo.png" type="image/png" sizes="16x16">

        </head>

        <body>
            <div class="profile-page-header">
                <div class="user-profile-image">
                    <div class="user-profile-user-image-and-username">
                        <?php
                        if (!$profileImg == "") {
                        ?>
                        <div class="user-profile-user-image" style="background-image:url('data:image/jpg;charset=utf8;base64,<?php echo base64_encode($profileImg); ?>')">
                            <!-- Image Here -->
                        </div>
                        <?php
                        } else {
                        ?>
                        <div class="user-profile-user-image" style="background-image:url('content/default/defaultprofile.png')">
                            <!-- Image Here -->
                        </div>
                        <?php
                        }
                        ?>
                        <div class="user-profile-user-name">
                            <h3><?php echo $username; ?></h3>
                        </div>
                    </div>
                </div>
                <div class="user-profile-user-class">
                    <h2><?php echo $class;  ?></h2>
                </div>
            </div>

            <!-- Personal Details -->

            <div class="profile-page-user-details">
                <div class="profile-page-user-personal-details">
                    <div class="profile-page-user-personal-details-box">
                        <div class="profile-page-user-personal-details-title">
                            <h4>Personal Details</h4>
                        </div>
                        <div class="profile-page-user-personal-details-all-user-details">
                            <div class="profile-page-user-personal-details-single-detail">
                                <div class="profile-page-user-personal-details-single-detail-title">
                                    <h5>Name</h5>
                                </div>
                                <div class="profile-page-user-personal-details-single-detail-data">
                                    <p><?php echo $username;  ?></p>
                                </div>
                            </div>
                            <hr class="personal-details-profile-hr">
                            <div class="profile-page-user-personal-details-single-detail">
                                <div class="profile-page-user-personal-details-single-detail-title">
                                    <h5>Email</h5>
                                </div>
                                <div class="profile-page-user-personal-details-single-detail-data">
                                    <p><?php echo $email;  ?></p>
                                </div>
                            </div>
                            <hr class="personal-details-profile-hr">
                            <div class="profile-page-user-personal-details-single-detail">
                                <div class="profile-page-user-personal-details-single-detail-title">
                                    <h5>Gender</h5>
                                </div>
                                <div class="profile-page-user-personal-details-single-detail-data">
                                    <p><?php echo $gender;  ?></p>
                                </div>
                            </div>
                            <hr class="personal-details-profile-hr">
                            <div class="profile-page-user-personal-details-single-detail">
                                <div class="profile-page-user-personal-details-single-detail-title">
                                    <h5>City</h5>
                                </div>
                                <div class="profile-page-user-personal-details-single-detail-data">
                                    <p><?php echo $city;  ?></p>
                                </div>
                            </div>
                            <hr class="personal-details-profile-hr">
                            <div class="profile-page-user-personal-details-single-detail">
                                <div class="profile-page-user-personal-details-single-detail-title">
                                    <h5>Date of Birth</h5>
                                </div>
                                <div class="profile-page-user-personal-details-single-detail-data">
                                    <p><?php echo $dob;  ?></p>
                                </div>
                            </div>
                            <hr class="personal-details-profile-hr">
                            <div class="profile-page-user-personal-details-single-detail">
                                <div class="profile-page-user-personal-details-single-detail-title">
                                    <h5>Standard</h5>
                                </div>
                                <div class="profile-page-user-personal-details-single-detail-data">
                                    <p><?php echo $class;  ?></p>
                                </div>
                            </div>
                            <hr class="personal-details-profile-hr">
                            <div class="profile-page-user-personal-details-single-detail">
                                <div class="profile-page-user-personal-details-single-detail-title">
                                    <h5>Board</h5>
                                </div>
                                <div class="profile-page-user-personal-details-single-detail-data">
                                    <p><?php echo $board;  ?></p>
                                </div>
                            </div>
                            <hr class="personal-details-profile-hr">
                            <div class="profile-page-user-personal-details-single-detail">
                                <div class="profile-page-user-personal-details-single-detail-title">
                                    <h5>Role</h5>
                                </div>
                                <div class="profile-page-user-personal-details-single-detail-data">
                                    <p><?php echo $role;  ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Details -->
                <div class="profile-page-user-personal-details">
                    <div class="profile-page-user-personal-details-box">
                        <div class="profile-page-user-personal-details-title">
                            <h4>Account Details</h4>
                        </div>
                        <div class="profile-page-user-personal-details-all-user-details">
                            <div class="profile-page-user-personal-details-single-detail">
                                <div class="profile-page-user-personal-details-single-detail-title">
                                    <h5>Mobile No</h5>
                                </div>
                                <div class="profile-page-user-personal-details-single-detail-data">
                                    <p><?php echo $phone;  ?></p>
                                </div>
                            </div>
                            <hr class="personal-details-profile-hr">
                            <div class="profile-page-user-personal-details-single-detail">
                                <div class="profile-page-user-personal-details-single-detail-title">
                                    <h5>Password</h5>
                                </div>
                                <div id="change-pass-profile-page" class="profile-page-user-personal-details-single-detail-data">
                                    <p>**********</p>
                                    <p><a href="#">Change Password</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->

                <div class="profile-page-user-action-btns">
                    <div class="profile-page-user-action-btn-edit-profile">
                        <button>Edit Profile</button>
                    </div>
                    <div class="profile-page-user-action-btn-back-btn">
                        <button onclick="window.history.back()">Back</button>
                    </div>
                </div>
            </div>
        </body>

        </html>
<?php

    } else {
        echo $_SESSION['loginErrors'] = "nouserfound";
        echo "<script>window.location.replace('index.php');</script>";
    }
} else {
    echo $_SESSION['loginErrors'] = "supecious";
    header('Location: index.php'); 
}

?>