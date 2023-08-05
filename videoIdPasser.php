<?php
session_start();
if(isset($_POST['play_btn'])){
    if(isset($_POST['video_item'])){
        $_SESSION['play_btn'] = true;
        $_SESSION['video_item'] = $_POST['video_item'];
        header("Location: videoPage.php");
    }else{
        $_SESSION['video_item'] = false;
        header("Location: logout.php");
    }
}else{
    $_SESSION['play_btn'] = false;
    header("Location: logout.php");
}
?>