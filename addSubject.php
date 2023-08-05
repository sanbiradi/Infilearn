<?php




session_start();
include('dbconnect.php');
if (isset($_POST['subject_submit_btn'])) {
    if (isset($_POST['subject_name'])) {
        if ($_POST['subject_name'] != "") {
            if (isset($_POST['select_board_dropdown'])) {
                if ($_POST['select_board_dropdown'] != "") {
                    if (isset($_POST['select_class_dropdown'])) {
                        if ($_POST['select_class_dropdown'] != "") {

                            $board =  $_POST['select_board_dropdown'];
                            $class = $_POST['select_class_dropdown'];
                            $subject =  $_POST['subject_name'];
                            // Setting Image Path
                            if (preg_match("/Mathematics/i", $subject)) {
                                $imagePath = "content/icons/compass.svg";
                            }
                            if (preg_match("/Science/i", $subject)) {
                                $imagePath = "content/icons/science.svg";
                            }
                            if (preg_match("/English/i", $subject)) {
                                $imagePath = "content/icons/dictionary.svg";
                            }
                            if (preg_match("/Social Science/i", $subject)) {
                                $imagePath = "content/icons/leader.svg";
                            }
                            if (preg_match("/Marathi/i", $subject)) {
                                $imagePath = "content/icons/marathi.png";
                            }
                            if (preg_match("/Hindi/i", $subject)) {
                                $imagePath = "content/icons/hindi.png";
                            }

                            $sql = "INSERT INTO subjects(standard,board,subjectname,imagepath) VALUES('$class','$board','$subject','$imagePath')";
                            if ($conn->query($sql) === TRUE) {
                                $_SESSION['usererrors'] = "syllabusUploaded";
                                echo "<script>window.location.replace('adminPanel.php');</script>";
                            } else {
                                $_SESSION['usererrors'] = "syllabusUploadedFailed";
                                echo "<script>window.location.replace('adminPanel.php');</script>";
                            }
                        } else {
                            $_SESSION['usererrors'] = "ClassSelectNull";
                            echo "<script>window.location.replace('adminPanel.php');</script>";
                        }
                    } else {
                        $_SESSION['usererrors'] = "ClassSelectNull";
                        echo "<script>window.location.replace('adminPanel.php');</script>";
                    }
                } else {
                    $_SESSION['usererrors'] = "BoardSelectNull";
                    echo "<script>window.location.replace('adminPanel.php');</script>";
                }
            } else {
                $_SESSION['usererrors'] = "BoardSelectNull";
                echo "<script>window.location.replace('adminPanel.php');</script>";
            }
        } else {
            $_SESSION['usererrors'] = "SubjectTextNull";
            echo "<script>window.location.replace('adminPanel.php');</script>";
        }
    } else {
        $_SESSION['usererrors'] = "SubjectTextNull";
        echo "<script>window.location.replace('adminPanel.php');</script>";
    }
} else {
    $_SESSION['loginErrors'] = "supecious";
    header("Location: index.php");
}
