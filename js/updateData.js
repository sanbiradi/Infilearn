// Block a User
function UpdateBlockUser(userid) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("GET", "blockUser.php?key="+userid, true);
    xhttp.send();
    
}


// Un-Block a User
function UpdateUnBlockUser(userid) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("GET", "unBlockUser.php?key="+userid, true);
    xhttp.send();
}


// Delete a User
function UpdateDeleteUser(userid) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        }
    };
    xhttp.open("GET", "deleteUser.php?key="+userid, true);
    xhttp.send();
}


// Edit a video
function EditVideo(id) {
    window.location.href  = 'EditVideoDetails.php?key='+id, '_blank';    
}

// Remove a video
function RemoveVideo(id) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        }
    };
    xhttp.open("GET", "removeVideo.php?key="+id, true);
    xhttp.send();
}


// Edit a File
function EditFile(id) {
    window.location.href  = 'EditFileDetails.php?key='+id, '_blank';    
}


// Remove a File
function RemoveVideo(id) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        }
    };
    xhttp.open("GET", "removeFile.php?key="+id, true);
    xhttp.send();
} 


// Remove a Request
function RemoveRequest(fileid, filetype) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        }
    };
    xhttp.open("GET", "removeRequest.php?path="+fileid+"&type="+filetype, true);
    xhttp.send();
}
