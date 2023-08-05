<?php
session_start();
include('dbconnect.php');

if (isset($_GET['b'])) {
    if ($_GET['b'] != "") {

        @$board = mysqli_escape_string($conn, $_GET['b']);
        @$_SESSION['board'] = $board;
        // standard
        // board
        @$sql = "SELECT * FROM classes WHERE board = '$board'";
        $result = $conn->query($sql);
        if (@$result->num_rows > 0) {
?>
            <option selected disabled>Select Class</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                $standard = $row['standard'];
                $class = $standard;
                if($standard == "1"){
                    $class = "1st";
                }
                if($standard == "2"){
                    $class = "2nd";
                }
                if($standard == "3"){
                    $class = "3rd";
                }
                if($standard == "4"){
                    $class = "4th";
                }
                if($standard == "5"){
                    $class = "5th";
                }
                if($standard == "6"){
                    $class = "6th";
                }
            ?>
                <option value="<?php echo $standard; ?>"><?php echo $class; ?></option>
            <?php
            }
        } else {
            ?>
            <option selected disabled>No Class Found</option>
<?php
        }
    }
}

?>