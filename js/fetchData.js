
// $(document).ready(function(){
//     manageuserallusertable();
// });

// To display all users
function manageuserallusertable() {
    var response = '';
    $.ajax({
        type: "GET",
        url: "alluser.php",
        async: false,
        success: function(text) {
            response = text;
        }
    });

   $('#manage-user-all-user-table').html(response);
    
}

// to display blocked users

function manageuserblockedusertable() {
    var response = '';
    $.ajax({
        type: "GET",
        url: "blockedUsers.php",
        async: false,
        success: function(text) {
            response = text;
        }
    });

   $('#manage-user-blocked-user-table').html(response);
    
}

function adminrequestgetdatatable() {
    var response = '';
    $.ajax({
        type: "GET",
        url: "fetchRequest.php",
        async: false,
        success: function(text) {
            response = text;
        }
    });

   $('#admin-request-get-data-table').html(response);
    
}

