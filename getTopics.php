<?php
session_start();
include('dbconnect.php');

if (isset($_GET['c'])) {
    @$chapterName = mysqli_escape_string($conn, $_GET['c']);
    if (isset($_SESSION['board'])) {
        @$board = $_SESSION['board'];
        @$class = $_SESSION['class'];
        @$subjectName =  $_SESSION['subjectname'];
        @$_SESSION['chapterName'] =  $chapterName;
        @$sql = "SELECT * FROM topics WHERE board = '$board' AND class = '$class' AND subjectname= '$subjectName' AND chaptername = '$chapterName'";
        $result = $conn->query($sql);
        if (@$result->num_rows > 0) {
?>
            <option selected disabled>Select Topic</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                $topicname = $row['topicname'];
            ?>
                <option value="<?php echo $topicname; ?>"><?php echo $topicname; ?></option>
            <?php
            }
        } else {
            ?>
            <option selected disabled>No Topic Found</option>
        <?php
        }
    } else {
        @$sql = "SELECT * FROM topics WHERE chaptername = '$chapterName'";
        $result = $conn->query($sql);
        if (@$result->num_rows > 0) {
        ?>
            <option selected disabled>Select Topic</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                $topicname = $row['topicname'];
            ?>
                <option value="<?php echo $topicname; ?>"><?php echo $topicname; ?></option>
            <?php
            }
        } else {
            ?>
            <option selected disabled>No Topic Found</option>
<?php
        }
    }
}

?>