<?php
// session_start();
include('dbconnect.php');
?>

<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile No</th>
    <th>City</th>
    <th>Birth Date</th>
    <th>Gender</th>
    <th>Board</th>
    <th>Grade</th>
    <th>Registration Date</th>
    <th>Role</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
$sql = "SELECT * FROM user_login WHERE isblocked = 'false'";
$result = $conn->query($sql);
if (@$result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Name = $row['name'];
        $Email = $row['email'];
        $MobileNo = $row['phone'];
        $City = $row['city'];
        $BirthDate = $row['dob'];
        $Gender = $row['gender'];
        $Board = $row['board'];
        $Grade = $row['standard'];
        $RegistrationDate = $row['registration_date'];
        $Role = $row['role'];
        $Status = $row['status'];
        $isBlocked = $row['isblocked'];
        $user_id_block =  $row['userid'];

        if($isBlocked == "false"){
            echo '
                <tr>
                    <td>' . $Name . '</td>
                    <td>' . $Email . '</td>
                    <td>' . $MobileNo . '</td>
                    <td>' . $City . '</td>
                    <td>' . $BirthDate . '</td>
                    <td>' . $Gender . '</td>
                    <td>' . $Board . '</td>
                    <td>' . $Grade . '</td>
                    <td>' . $RegistrationDate . '</td>
                    <td>' . $Role . '</td>
                    <td>' . $Status . '</td>
                    <td class="admin-table-action-btns">
                        <button onclick="UpdateBlockUser(' . $user_id_block . ')">
                            <img src="content/icons/admin/block.svg" alt="remove action" height="15px">
                        </button> 
                        <br>
                        <button onclick="UpdateDeleteUser(' . $user_id_block . ')">
                            <img src="content/icons/admin/remove.svg" alt="block action" height="15px">
                        </button>
                    </td>
                </tr>

            ';
        }
        
    }
} else {
?>
    <tr>
        <td colspan="12">
            <p style="width: 100%;text-align:center;height:200px;display: flex;justify-content:center;align-items:center;">
                No Data Found :(
            </p>
        </td>
    </tr>
<?php
}

?>