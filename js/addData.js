/*------------------------------- Add Subject -------------------------------*/

/*--------Show Class - Subject  --------*/

function ShowClassSyllabus(board) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("select-class-syllabus-subject").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getClass.php?b="+board, true);
    xhttp.send();
}


/*------------------------------- Add Chapter -------------------------------*/


/*--------Show Class - Chapter  --------*/

function ShowClassSyllabusChapter(board) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("select-class-syllabus-chapter").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getClass.php?b="+board, true);
    xhttp.send();
}

/*--------Show Subject - Chapter  --------*/

function ShowSubjectSyllabusChapter(standard) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("select-subject-syllabus-chapter").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getSubjects.php?st="+standard, true); 
    xhttp.send();
}



/*------------------------------- Add Chapter Description -------------------------------*/


/*--------Show Class - Chapter  --------*/

function ShowClassSyllabusDesc(board) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("select-class-syllabus-desc").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getClass.php?b="+board, true);
    xhttp.send();
}

/*--------Show Subject - Chapter  --------*/

function ShowSubjectSyllabusDesc(standard) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("select-subject-syllabus-desc").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getSubjects.php?st="+standard, true); 
    xhttp.send();
}

/*--------Show Chapter - Chapter  --------*/

function ShowChapterSyllabusDesc(subject) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("select-chapter-syllabus-desc").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getChapters.php?s="+subject, true); 
    xhttp.send();
}







/*------------------------------- Add Chapter Topic -------------------------------*/

/*--------Show Class - Topic  --------*/

function ShowClassSyllabusTopic(board) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("select-class-syllabus-topic").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getClass.php?b="+board, true);
    xhttp.send();
}

/*--------Show Subject - Topic  --------*/

function ShowSubjectSyllabusTopic(standard) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("select-subject-syllabus-topic").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getSubjects.php?st="+standard, true); 
    xhttp.send();
}

/*--------Show Chapter - Topic  --------*/

function ShowChapterSyllabusTopic(subject) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("select-chapter-syllabus-topic").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getChapters.php?s="+subject, true); 
    xhttp.send();
}



 
// // For Updateing File Downloads

function UpdateDownloadFile(fileId) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("topic-select-file").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "UpdateFileDowload.php?key="+fileId, true);
    xhttp.send();
}
