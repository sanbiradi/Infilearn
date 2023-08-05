<?php


session_start();
include('dbconnect.php');
if (isset($_POST['topic_submit_btn'])) {
    if (isset($_POST['topic_name'])) {
        if ($_POST['topic_name'] != "") {
            if (isset($_POST['select_board_dropdown'])) {
                if ($_POST['select_board_dropdown'] != "") {
                    if (isset($_POST['select_class_dropdown'])) {
                        if ($_POST['select_class_dropdown'] != "") {
                            if (isset($_POST['select_subject_dropdown'])) {
                                if ($_POST['select_subject_dropdown'] != "") {
                                    if (isset($_POST['select_chapter_dropdown'])) {
                                        if ($_POST['select_chapter_dropdown'] != "") {

                                            $board =  $_POST['select_board_dropdown'];
                                            $class = $_POST['select_class_dropdown'];
                                            $subject =  $_POST['select_subject_dropdown'];
                                            $chapter = $_POST['select_chapter_dropdown'];
                                            $topicName = $_POST['topic_name'];
                                            
                                            $sql = "INSERT INTO topics(class,board,subjectname,chaptername,topicname,videoids) VALUES('$class','$board','$subject','$chapter','$topicName','null')";
                                            if ($conn->query($sql) === TRUE) {

                                                $sql_subject = "SELECT * FROM topics WHERE board = '$board' AND class = '$class' AND subjectname= '$subject' AND chaptername = '$chapter' AND topicname = '$topicName'";
                                                $result = $conn->query($sql_subject);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $topic_id =  $row['id'];
                                                    }

                                                    $sql_subject_select = "SELECT * FROM chapters WHERE board = '$board' AND standard = '$class' AND subjectname= '$subject' AND chaptername = '$chapter'";
                                                    $result = $conn->query($sql_subject_select);
                                                    if (@$result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $topicids =  $row['topicsids'];
                                                            if ($topicids != "") {
                                                                $topicid_arr = unserialize($topicids);
                                                                array_push($topicid_arr, "$topic_id");
                                                                $topicid_str = serialize($topicid_arr);
                                                            } else {
                                                                $topicid_arr = array("$topic_id");
                                                                $topicid_str = serialize($topicid_arr);
                                                            }
                                                        }
                                                        $conn->query("UPDATE chapters SET topics = topics+1, topicsids = '$topicid_str' WHERE board = '$board' AND standard = '$class' AND subjectname = '$subject' AND chaptername = '$chapter'");
                                                        $_SESSION['usererrors'] = "syllabusUploaded";
                                                        echo "<script>window.location.replace('adminPanel.php');</script>";
                                                        
                                                    }else {
                                                        $_SESSION['usererrors'] = "syllabusUploadedFailed";
                                                        echo "<script>window.location.replace('adminPanel.php');</script>";
                                                    }
                                                }else {
                                                    $_SESSION['usererrors'] = "syllabusUploadedFailed";
                                                    echo "<script>window.location.replace('adminPanel.php');</script>";
                                                }
                                            } else {
                                                $_SESSION['usererrors'] = "syllabusUploadedFailed";
                                                echo "<script>window.location.replace('adminPanel.php');</script>";
                                            }
                                        } else {
                                            $_SESSION['usererrors'] = "chapterSelectNull";
                                            echo "<script>window.location.replace('adminPanel.php');</script>";
                                        }
                                    } else {
                                        $_SESSION['usererrors'] = "chapterSelectNull";
                                        echo "<script>window.location.replace('adminPanel.php');</script>";
                                    }
                                } else {
                                    $_SESSION['usererrors'] = "SubjectSelectNull";
                                    echo "<script>window.location.replace('adminPanel.php');</script>";
                                }
                            } else {
                                $_SESSION['usererrors'] = "SubjectSelectNull";
                                echo "<script>window.location.replace('adminPanel.php');</script>";
                            }
                        } else {
                            $_SESSION['usererrors'] = "ClassSelectNull";
                            echo "<script>window.location.replace('adminPanel.php');</script>";
                        }
                    } else {
                        $_SESSION['usererrors'] = "ClassSelectNull";
                        echo "<script>window.location.replace('adminPanel.php');</script>";
                    }
                } else {
                    $_SESSION['usererrors'] = "BoardSelectNull";
                    echo "<script>window.location.replace('adminPanel.php');</script>";
                }
            } else {
                $_SESSION['usererrors'] = "BoardSelectNull";
                echo "<script>window.location.replace('adminPanel.php');</script>";
            }
        } else {
            $_SESSION['usererrors'] = "TopicTextNull";
            echo "<script>window.location.replace('adminPanel.php');</script>";
        }
    } else {
        $_SESSION['usererrors'] = "TopicTextNull";
        echo "<script>window.location.replace('adminPanel.php');</script>";
    }
} else {
    $_SESSION['loginErrors'] = "supecious";
    header("Location: index.php");
}
