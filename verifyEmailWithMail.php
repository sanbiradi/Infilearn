<?php
session_start();
include('dbconnect.php');

if (isset($_GET['key']) && isset($_GET['email']) && isset($_GET['name'])) {
    if ($_GET['key'] != "" && $_GET['email'] != "" && $_GET['name'] != "") {

        @$userid = mysqli_escape_string($conn, $_GET['key']);
        @$username = mysqli_escape_string($conn, $_GET['name']);
        @$useremail = mysqli_escape_string($conn, $_GET['email']);

        @$sql = "UPDATE user_login SET isVerfied = 'true' WHERE userid = '$userid' AND email = '$useremail'";
        $conn->query($sql);

        header('Location: index.php');
    }
}else{
    header('Location: index.php');
} 

?>