<?php
include('dbconnect.php');
if (isset($_POST['update_videos_btn'])) {
    if (isset($_POST['video_title'])) {
        if (isset($_POST['video_desc'])) {
            if (isset($_GET['key'])) {
                if ($_GET['key'] != "") {
                    $file_upload_id = mysqli_escape_string($conn, $_GET['key']);
                    $file_title_update = $_POST['video_title'];
                    $file_desc_update =  $_POST['video_desc'];
                    $sql_update = "UPDATE fileuploaded SET title = '$file_title_update', description = '$file_desc_update' WHERE id = '$file_upload_id'";
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
