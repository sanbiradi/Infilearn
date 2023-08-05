<?php
session_start();
include('dbconnect.php');

if (isset($_GET['path'])) {
    if ($_GET['path'] != "" ) {
        if ($_SESSION['role_pre'] == "Admin") {
            @$file_id = mysqli_escape_string($conn, $_GET['path']);
            @$file_type = mysqli_escape_string($conn, $_GET['type']);

            if($file_type == "File"){
                @$sql = "UPDATE filerequests SET isaccepted = 'true' WHERE id = '$file_id'";
                @$conn->query($sql);
            }
            if($file_type == "Video"){
                @$sql = "UPDATE videorequests SET isaccepted = 'true' WHERE id = '$file_id'";
                @$conn->query($sql);
            }
            
        }else{
            echo "<script>window.location.replace('index.php');</script>";
        }
    }
}else{
    header('Location: index.php');
}

?>