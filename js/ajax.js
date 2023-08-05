// Show Class
function ShowClass(board) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("class-select").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getClass.php?b="+board, true);
    xhttp.send();
}

// Show Subjects

function ShowSubject(standard) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("subject-select").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getSubjects.php?st="+standard, true);
    xhttp.send();
}


// For getting Chapters
function ShowChapter(subject) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chapter-select").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getChapters.php?s="+subject, true);
    xhttp.send();
}


// For getting Topics
function ShowTopics(chapter) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("topic-select").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getTopics.php?c="+chapter, true);
    xhttp.send();
}

// -------------------------  For File Page  ------------------------

// Show Class
function ShowClassFile(board) {
    var xhttp;  
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("class-select-file").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getClass.php?b="+board, true);
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


function ShowChapterFile(subject) { 
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
function ShowTopicsFile(chapter) {
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

