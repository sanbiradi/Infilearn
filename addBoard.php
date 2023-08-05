<?php
session_start();
include('dbconnect.php');
if(isset($_POST['addBoard_btn'])){
    if(isset($_POST['Board_txt'])){
        if($_POST['Board_txt'] != "" ){
            $board =  $_POST['Board_txt'];
            $sql = "INSERT INTO boards(name) VALUES('$board')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['usererrors'] = "syllabusUploaded";
                echo "<script>window.location.replace('adminPanel.php');</script>";
            }else{
                $_SESSION['usererrors'] = "syllabusUploadedFailed";
                echo "<script>window.location.replace('adminPanel.php');</script>";
            }
        }else{
            $_SESSION['usererrors'] = "BoardTextNull";
            echo "<script>window.location.replace('adminPanel.php');</script>";
        }
    }else{
        $_SESSION['usererrors'] = "BoardTextNull";
        echo "<script>window.location.replace('adminPanel.php');</script>";
    }
}else{
    $_SESSION['loginErrors'] = "supecious";
    header("Location: index.php");
}


?>