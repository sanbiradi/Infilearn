<?php
include("dbconnect.php");
session_start();
$videoid = $_SESSION['video_id_curr'];
$commentQuery = "SELECT id, parent_id, comment, sender, videoid, date FROM comment WHERE parent_id = '0' AND videoid = '$videoid' ORDER BY id DESC";
$commentsResult = mysqli_query($conn, $commentQuery) or die("database error:". mysqli_error($conn));
$commentHTML = '';
while($comment = mysqli_fetch_assoc($commentsResult)){
	$commentHTML .= '
	<div class="section-video-player-video-data-qna-single-comment">
        <div class="section-video-player-video-data-qna-single-comment-username">
			<h3><b>'.$comment["sender"].'</b> ~ <span id="comment-date">'.$comment["date"].'</span></h3>
        </div>
        <div class="section-video-player-video-data-qna-single-comment-user-comment">
            <p>'.$comment["comment"].'</p>
        </div>
        <hr class="single-video-comment-hr">
    </div>
				';
	$commentHTML .= getCommentReply($conn, $comment["id"]);
}
if($commentHTML == ""){
	$commentHTML = ' <div class="section-video-player-video-data-qna-single-comment">
	<h3><b>No Comments found, Be The First</b></h3>
</div>';
echo $commentHTML;
}else{
	echo $commentHTML;
}


function getCommentReply($conn, $parentId = 0, $marginLeft = 0) {
	$videoid = $_SESSION['video_id_curr'];
	$commentHTML = '';
	$commentQuery = "SELECT id, parent_id, comment, sender, videoid, date FROM comment WHERE parent_id = '$parentId' AND videoid = '$videoid' ";	
	$commentsResult = mysqli_query($conn, $commentQuery);
	$commentsCount = mysqli_num_rows($commentsResult);
	if($parentId == 0) {
		$marginLeft = 0;
	} else {
		$marginLeft = $marginLeft + 48;
	}
	if($commentsCount > 0) {
		while($comment = mysqli_fetch_assoc($commentsResult)){  
			$commentHTML .= '
			<div class="section-video-player-video-data-qna-single-comment">
                <div class="section-video-player-video-data-qna-single-comment-username">
					<h3><b>'.$comment["sender"].'</b> on <span id="comment-date">'.$comment["date"].'</span></h3>
                </div>
                <div class="section-video-player-video-data-qna-single-comment-user-comment">
                    <p>'.$comment["comment"].'</p>
                </div>
                <hr class="single-video-comment-hr">
            </div>
				';
			$commentHTML .= getCommentReply($conn, $comment["id"], $marginLeft);
		}
	}
	return $commentHTML;
}
?>