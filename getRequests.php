<?php
include('dbconnect.php');

$sql_req = "SELECT filepath , board , standard , subject , chapter , topic , title , description , uploadtime , email FROM videouploaded UNION ALL SELECT filepath , board , standard , subject , chapter , topic , title , description , uploadtime , email FROM fileuploaded";
$result = $conn->query($sql_req);

if ($result->num_rows > 0) {

    echo '<tr>
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
</tr>';
    while ($row = $result->fetch_assoc()) {
        $filePath =  $row['filepath'];
        // if(preg_match('/pdf/' , $filepath)){
        //     $req_fileType = "File";
        // }
        // if(preg_match('/mp4/' , $filepath)){
        //     $req_fileType = "Video";
        // }
        $req_fileType = "Video";
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
                    <button>
                        <img src="content/icons/admin/download.svg" alt="edit action" height="15px">
                    </button>
                    <button>
                        <img src="content/icons/admin/remove.svg" alt="remove action" height="15px">
                    </button>
                </td>
            </tr>
            ';
    }
} else {
    echo '
        <tr>
            <td colspan="12" style="text-align:center;height:300px;">Sorry,No Data Found! :(</td>
        </tr>
        ';
}
