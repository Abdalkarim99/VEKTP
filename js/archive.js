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
            displayArchive: displayData
        },
        success: function(data, status) {
            $('#displayDataTable').html(data);
        }

    });

}

//filter ReferenceNo function
function fitlerReferenceNo() {
    var filterReferenceNo = $('#referenceNo').val();
    $.ajax({
        url: "display.php",
        type: 'post',
        data: {
            filterReferenceNo: filterReferenceNo
        },
        success: function(data, status) {
            console.log(status);
            $('#displayDataTable').html(data);
        }
    });
}

//filter Email function 
function fitlerEmail() {
    var filterEmail = $('#email').val();
    $.ajax({
        url: "display.php",
        type: 'post',
        data: {
            filterEmail: filterEmail
        },
        success: function(data, status) {
            console.log(status);
            $('#displayDataTable').html(data);
        }
    });
}

//filter Date function
function fitlerDate() {
    var filterDate = $('#date').val();
    $.ajax({
        url: "display.php",
        type: 'post',
        data: {
            filterDate: filterDate
        },
        success: function(data, status) {
            console.log(status);
            $('#displayDataTable').html(data);
        }
    });
}

//add Arcihve document

function addDocument() {

    var dateAdd = $('#completedate').val();
    var referenceAdd = $('#completereference').val();
    var invoiceAdd = $('#completeinvoice').val();
    var paidAdd = $('#completepaid').val();
    var emailAdd = $('#completemail').val();

    var formData = new FormData();
    var fileInput = $('#pdf')[0];
    formData.append('pdf', fileInput.files[0]);

    $.ajax({
        url: 'upload.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            // File uploaded successfully, now insert other data into database
            $.ajax({
                url: 'insert.php',
                type: 'POST',
                data: {
                    dateSend: dateAdd,
                    referenceSend: referenceAdd,
                    invoiceSend: invoiceAdd,
                    paidSend: paidAdd,
                    emailSend: emailAdd,
                    pdfSend: response // PDF file name returned from upload.php
                },
                success: function(data, status) {
                    $('#addDocument').modal('hide');
                    displayData();
                }
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus + ' ' + errorThrown);
        }
    });
}



//delete Archive

function DeleteArchive(deleteid) {
    $.ajax({
        url: "delete.php",
        type: 'post',
        data: {
            deleteArchive: deleteid
        },
        success: function(data, success) {
            displayData();
        }
    });
}

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}