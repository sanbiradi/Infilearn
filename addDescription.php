<?php


session_start();
include('dbconnect.php');
if (isset($_POST['desc_submit_btn'])) {
    if (isset($_POST['chapter_desc'])) {
        if ($_POST['chapter_desc'] != "") {
            if (isset($_POST['select_board_dropdown'])) {
                if ($_POST['select_board_dropdown'] != "") {
                    if (isset($_POST['select_class_dropdown'])) {
                        if ($_POST['select_class_dropdown'] != "") {
                            if (isset($_POST['select_subject_dropdown'])) {
                                if ($_POST['select_subject_dropdown'] != "") {
                                    if (isset($_POST['select_chapter_dropdown'])) {
                                        if ($_POST['select_chapter_dropdown'] != "") {

                                            $board =  $_POST['select_board_dropdown'];
                                            $class = $_POST['select_class_dropdown'];
                                            $subject =  $_POST['select_subject_dropdown'];
                                            $chapter = $_POST['select_chapter_dropdown'];
                                            $description = $_POST['chapter_desc'];
                                                                                        
                                            $sql = "UPDATE chapters SET description = '$description' WHERE board = '$board' AND standard = '$class' AND subjectname = '$subject' AND chaptername = '$chapter'";
                                            if ($conn->query($sql) === TRUE) {
                                                $_SESSION['usererrors'] = "syllabusUploaded";
                                                echo "<script>window.location.replace('adminPanel.php');</script>";
                                            } else {
                                                $_SESSION['usererrors'] = "syllabusUploadedFailed";
                                                echo "<script>window.location.replace('adminPanel.php');</script>";
                                            }
                                        } else {
                                            $_SESSION['usererrors'] = "chapterSelectNull";
                                            echo "<script>window.location.replace('adminPanel.php');</script>";
                                        }
                                    } else {
                                        $_SESSION['usererrors'] = "chapterSelectNull";
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
            $_SESSION['usererrors'] = "DescTextNull";
            echo "<script>window.location.replace('adminPanel.php');</script>";
        }
    } else {
        $_SESSION['usererrors'] = "DescTextNull";
        echo "<script>window.location.replace('adminPanel.php');</script>";
    }
} else {
    $_SESSION['loginErrors'] = "supecious";
    header("Location: index.php");
}
