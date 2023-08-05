<?php


session_start();
include('dbconnect.php');
if (isset($_POST['chapter_submit_btn'])) {
    if (isset($_POST['chapter_name'])) {
        if ($_POST['chapter_name'] != "") {
            if (isset($_POST['select_board_dropdown'])) {
                if ($_POST['select_board_dropdown'] != "") {
                    if (isset($_POST['select_class_dropdown'])) {
                        if ($_POST['select_class_dropdown'] != "") {
                            if (isset($_POST['select_subject_dropdown'])) {
                                if ($_POST['select_subject_dropdown'] != "") {

                                    $board =  $_POST['select_board_dropdown'];
                                    $class = $_POST['select_class_dropdown'];
                                    $subject =  $_POST['select_subject_dropdown'];
                                    $chapter = $_POST['chapter_name'];
                                    $description = "Welcome to the " . $chapter . " Section. Hope you will enjoy learning :)";

                                    $sql = "INSERT INTO chapters(standard,board,subjectname,chaptername,description) VALUES('$class','$board','$subject','$chapter','$description')";
                                    if ($conn->query($sql) === TRUE) {
                                        $_SESSION['usererrors'] = "syllabusUploaded";
                                        echo "<script>window.location.replace('adminPanel.php');</script>";
                                    } else {
                                        $_SESSION['usererrors'] = "syllabusUploadedFailed";
                                        echo "<script>window.location.replace('adminPanel.php');</script>";
                                    }
                                } else {
                                    $_SESSION['usererrors'] = "SubjectSelectNull";
                                    echo "<script>window.location.replace('adminPanel.php');</script>";
                                }
                            } else {
                                $_SESSION['usererrors'] = "SubjectSelectNull";
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
            $_SESSION['usererrors'] = "ChapterTextNull";
            echo "<script>window.location.replace('adminPanel.php');</script>";
        }
    } else {
        $_SESSION['usererrors'] = "ChapterTextNull";
        echo "<script>window.location.replace('adminPanel.php');</script>";
    }
} else {
    $_SESSION['loginErrors'] = "supecious";
    header("Location: index.php");
}
