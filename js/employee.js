$(document).ready(function() {
    displayData();
});

//display function
function displayData() {
    var displayData = "true";
    $.ajax({
        url: "display.php",
        type: 'post',
        data: {
            displaySend: displayData
        },
        success: function(data, status) {
            $('#displayDataTable').html(data);
        }

    });

}

//add user

function adduser() {
    var nameAdd = $('#completename').val();
    var phoneAdd = $('#completephone').val();
    var roleAdd = $('#completerole').val();
    var emailAdd = $('#completemail').val();

    $.ajax({
        url: "insert.php",
        type: 'post',
        data: {
            nameSend: nameAdd,
            phoneSend: phoneAdd,
            roleSend: roleAdd,
            emailSend: emailAdd
        },
        success: function(data, status) {
            //function to display data
            // console.log(status);
            $('#addEmployee').modal('hide');
            displayData();
        }
    });
}

//delete user

function DeleteUser(deleteid) {
    $.ajax({
        url: "delete.php",
        type: 'post',
        data: {
            deleteSend: deleteid
        },
        success: function(data, success) {
            displayData();
        }
    });
}

//Edit user in table
function EditUser(updateid) {
    $('#hiddendata').val(updateid);

    $.post("update.php", {
        updateid: updateid
    }, function(data, status) {
        var userid = JSON.parse(data);
        $('#updatename').val(userid.name);
        $('#updatephone').val(userid.phone);
        $('#updaterole').val(userid.role);
        $('#updatemail').val(userid.email);

    });


    $('#updateUser').modal("show");

}

//Edit user details
function EditUserDetails() {
    var updatename = $('#updatename').val();
    var updatephone = $('#updatephone').val();
    var updaterole = $('#updaterole').val();
    var updatemail = $('#updatemail').val();
    var hiddendata = $('#hiddendata').val();

    $.post("update.php", {
        updatename: updatename,
        updatephone: updatephone,
        updaterole: updaterole,
        updatemail: updatemail,
        hiddendata: hiddendata
    }, function(data, status) {
        $('#updateUser').modal('hide');
        displayData();

    });
}

//Search User
function searchTable() {
    let input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("displayDataTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (let j = 0; j < td.length; j++) {
            txtValue = td[j].textContent || td[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                break;
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// Attach an event listener to the search input to trigger the search function
document.getElementById("searchInput").addEventListener("keyup", searchTable);