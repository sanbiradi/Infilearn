<?php
session_start();
include("dbconnect.php");
if(!empty($_POST["name"]) && !empty($_POST["comment"])){
	$videoid = $_SESSION['video_id_curr'];
	$insertComments = "INSERT INTO comment (parent_id, comment, sender, videoid) VALUES ('".$_POST["commentId"]."', '".$_POST["comment"]."', '".$_POST["name"]."', '".$videoid."')";
	mysqli_query($conn, $insertComments) or die("database error: ". mysqli_error($conn));	
	$message = '<label class="text-success">Comment posted Successfully.</label>';
	$status = array(
		'error'  => 0,
		'message' => $message
	);	
} else {
	$message = '<label class="text-danger">Error: Comment not posted.</label>';
	$status = array(
		'error'  => 1,
		'message' => $message
	);	
}
echo json_encode($status);
?>