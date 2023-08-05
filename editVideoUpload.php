<?php
include('dbconnect.php');
if (isset($_POST['update_videos_btn'])) {
    if (isset($_POST['video_title'])) {
        if (isset($_POST['video_desc'])) {
            if (isset($_GET['key'])) {
                if ($_GET['key'] != "") {
                    $video_upload_id = mysqli_escape_string($conn, $_GET['key']);
                    $video_title_update = $_POST['video_title'];
                    $video_desc_update =  $_POST['video_desc'];
                    $sql_update = "UPDATE videouploaded SET title = '$video_title_update', description = '$video_desc_update' WHERE id = '$video_upload_id'";
                    if ($conn->query($sql_update) === TRUE) {
                        $_SESSION['usererrors'] = "DataUpdated";
                        echo "<script>window.location.replace('adminPanel.php');</script>";
                    } else {
                        $_SESSION['usererrors'] = "DataUpdatedFailed";
                        echo "<script>window.location.replace('adminPanel.php');</script>";
                    }
                }else {
                    echo "<script>window.location.replace('adminPanel.php');</script>";
                }
            }else {
                echo "<script>window.location.replace('adminPanel.php');</script>";
            }
        }else {
            echo "<script>window.location.replace('adminPanel.php');</script>";
        }
    }else {
        echo "<script>window.location.replace('adminPanel.php');</script>";
    }
}else {
    echo "<script>window.location.replace('index.php');</script>";
}
