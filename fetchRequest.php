<?php
session_start();
include('dbconnect.php');
?>
<tr>
    <th>Type</th>
    <th>Board</th>
    <th>Class</th>
    <th>Subject</th>
    <th>Chapter</th>
    <th>Topic</th>
    <th>Title</th>
    <th>Description</th>
    <th>Date/Time</th>
    <th>Name</th>
    <th>Email</th>
    <th>Action</th>
</tr>

<?php

$sql_req = "SELECT id, filepath , board , standard , subject , chapter , topic , title , description , uploadtime , email, filepath, isaccepted FROM videorequests UNION ALL SELECT id, filepath , board , standard , subject , chapter , topic , title , description , uploadtime , email, filepath, isaccepted FROM filerequests ORDER BY uploadtime DESC ";
$result = $conn->query($sql_req);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $filePath =  $row['filepath'];

        if (preg_match('/pdf/', $filePath)) {
            $req_fileType = "File";
        }
        if (preg_match('/mp4/', $filePath)) {
            $req_fileType = "Video";
        }
        $req_BoardTable = $row['board'];
        $req_ClassTable = $row['standard'];
        $req_SubjectTable = $row['subject'];
        $req_ChapterTable = $row['chapter'];
        $req_TopicTable = $row['topic'];
        $req_TitleTable = $row['title'];
        $req_DescriptionTable = $row['description'];
        $req_Upload_AtTable = $row['uploadtime'];
        $req_createdTable =  $row['email'];
        $req_createdEmailTable =  $row['email'];
        $req_file_id = $row['id'];
        $req_is_accepted = $row['isaccepted'];

        if ($req_is_accepted == 'false') {
            echo '
                <tr>
                    <td>' . $req_fileType . '</td>
                    <td>' . $req_BoardTable . '</td>
                    <td>' . $req_ClassTable . '</td>
                    <td>' . $req_SubjectTable . '</td>
                    <td>' . $req_ChapterTable . '</td>
                    <td>' . $req_TopicTable . '</td>
                    <td>' . $req_TitleTable . '</td>
                    <td>' . $req_DescriptionTable . '</td>
                    <td>' . $req_Upload_AtTable . '</td>
                    <td>' . $req_createdTable . '</td>
                    <td>' . $req_createdEmailTable . '</td>
                    <td class="admin-table-action-btns-manage-req"> 
                        <a href="' . $filePath . '" download="' . $filePath . '">
                            <button >
                                <img src="content/icons/admin/download.svg" alt="download" height="15px">
                            </button>
                        </a>
                        <button onclick="RemoveRequest(' . $req_file_id . ',' . "'$req_fileType'" . ')">
                            <img src="content/icons/admin/remove.svg" alt="remove action" height="15px">
                        </button>
                    </td>
                </tr>
                ';
        }
    }
} else {
    echo '
        <tr>
            <td colspan="12" style="text-align:center;height:300px;">Sorry,No Data Found! :(</td>
        </tr>
        ';
}

?>