function ShowClassFile(board) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("class-select-file").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getClass.php?b="+board, true);
    // alert(1);
    xhttp.send();
}

// Show Subjects

function ShowSubjectFile(standard) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("subject-select-file").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getSubjects.php?st="+standard, true);
    xhttp.send();
}


function ShowChapterFiles(subject) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chapter-select-file").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getChapters.php?s="+subject, true);
    xhttp.send();
}

 
// For getting Topics
function ShowTopicsFiles(chapter) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("topic-select-file").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getTopics.php?c="+chapter, true);
    xhttp.send();
}



function ShowAdminRequest() {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("admin-request-get-data-table").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getRequests.php", true);
    xhttp.send();
}



