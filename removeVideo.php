<?php
session_start();
include('dbconnect.php');

if (isset($_GET['key'])) {
    if ($_GET['key'] != "") {
        if ($_SESSION['role_pre'] == "Admin") {
            @$video_id = mysqli_escape_string($conn, $_GET['key']);
            @$sql = "DELETE FROM videouploaded WHERE id = '$video_id'";
            $conn->query($sql);
        }else{
            echo "<script>window.location.replace('index.php');</script>";
        }
    }
}else{
    header('Location: index.php');
}

?>