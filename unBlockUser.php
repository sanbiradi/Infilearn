<?php
session_start();
include('dbconnect.php');

if (isset($_GET['key'])) {
    if ($_GET['key'] != "") {
        if ($_SESSION['role_pre'] == "Admin") {
            @$userid = mysqli_escape_string($conn, $_GET['key']);
            @$sql = "UPDATE user_login SET isblocked = 'false' WHERE userid = '$userid'";
            $conn->query($sql);
            $_SESSION['usererrors'] = "manageUser";
        }else{
            echo "<script>window.location.replace('index.php');</script>";
        }
    }
}else{
    header('Location: index.php');
}

?>