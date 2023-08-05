<?php
session_start();
include('dbconnect.php');
if (isset($_POST['class_submit_btn'])) {
    if (isset($_POST['class_name'])) {
        if ($_POST['class_name'] != "") {
            if (isset($_POST['select_board_dropdown'])) {
                if ($_POST['select_board_dropdown'] != "") {

                    $board =  $_POST['select_board_dropdown'];
                    $class = $_POST['class_name'];
                    $sql = "INSERT INTO classes(standard,board) VALUES('$class','$board')";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['usererrors'] = "syllabusUploaded";
                        echo "<script>window.location.replace('adminPanel.php');</script>";
                    } else {
                        $_SESSION['usererrors'] = "syllabusUploadedFailed";
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
            $_SESSION['usererrors'] = "ClassTextNull";
            echo "<script>window.location.replace('adminPanel.php');</script>";
        }
    } else {
        $_SESSION['usererrors'] = "ClassTextNull";
        echo "<script>window.location.replace('adminPanel.php');</script>";
    }
} else {
    $_SESSION['loginErrors'] = "supecious";
    header("Location: index.php");
}
