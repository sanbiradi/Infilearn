<?php
session_start();
include('dbconnect.php');
if (isset($_GET['key'])) {
    if($_GET['key'] != ""){

        $videoId  = mysqli_escape_string($conn, $_GET['key']);

        $sql = "UPDATE fileuploaded SET views=views+1 WHERE id ='$videoId'";
        $conn->query($sql);

    }else{
        $_SESSION['loginErrors'] = "supecious";
        echo "<script>window.location.replace('index.php');</script>";
    }

} else {
    $_SESSION['loginErrors'] = "supecious";
    header("Location: index.php");
}


?>