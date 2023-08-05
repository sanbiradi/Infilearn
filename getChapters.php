<?php
session_start();
include('dbconnect.php');

if (isset($_GET['s'])) {
    @$subjectName = mysqli_escape_string($conn, $_GET['s']);
    if (isset($_SESSION['board'])) {
        @$board = $_SESSION['board'];
        @$class = $_SESSION['class'];
        @$_SESSION['subjectname'] = $subjectName;
        @$sql = "SELECT * FROM chapters WHERE board = '$board' AND standard = '$class' AND subjectname= '$subjectName'";
        $result = $conn->query($sql);
        if (@$result->num_rows > 0) {
?>
            <option selected disabled>Select Chapter</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                $chaptername = $row['chaptername'];
            ?>
                <option value="<?php echo $chaptername; ?>"><?php echo $chaptername; ?></option>
            <?php
            }
        } else {
            ?>
            <option selected disabled>No Chapter Found</option>
        <?php
        }
    } else {
        @$sql = "SELECT * FROM chapters WHERE subjectname = '$subjectName'";
        $result = $conn->query($sql);
        if (@$result->num_rows > 0) {
        ?>
            <option selected disabled>Select Chapter</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                $chaptername = $row['chaptername'];
            ?>
                <option value="<?php echo $chaptername; ?>"><?php echo $chaptername; ?></option>
            <?php
            }
        } else {
            ?>
            <option selected disabled>No Chapter Found</option>
<?php
        }
    }
}

?>