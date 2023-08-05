<?php
session_start();
include('dbconnect.php');

if (isset($_GET['st'])) {
    if ($_GET['st'] != "") {

        @$standard = mysqli_escape_string($conn, $_GET['st']);
        @$board =  $_SESSION['board'];
        @$_SESSION['class'] = $standard;
        // standard
        // board
        @$sql = "SELECT * FROM subjects WHERE standard = '$standard' AND board = '$board'";
        $result = $conn->query($sql);
        if (@$result->num_rows > 0) {
?>
            <option selected disabled>Select Subject</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                $subject = $row['subjectname'];
            ?>
                <option value="<?php echo $subject; ?>"><?php echo $subject; ?></option>
            <?php
            }
        } else {
            ?>
            <option selected disabled>No Subject Found</option>
<?php
        }
    }
}

?>