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
            displayProduct: displayData
        },
        success: function(data, status) {
            $('#displayDataTable').html(data);
        }

    });

}

//filter Name function
function fitlerName() {
    var filterName = $('#name').val();
    $.ajax({
        url: "display.php",
        type: 'post',
        data: {
            filterProductName: filterName
        },
        success: function(data, status) {
            console.log(status);
            $('#displayDataTable').html(data);
        }
    });
}

//filter Category function
function fitlerCategory() {
    var filterName = $('#category').val();
    $.ajax({
        url: "display.php",
        type: 'post',
        data: {
            filterProductCategory: filterName
        },
        success: function(data, status) {
            console.log(status);
            $('#displayDataTable').html(data);
        }
    });
}

//filter Price function
function fitlerPrice() {
    var filterName = $('#price').val();
    $.ajax({
        url: "display.php",
        type: 'post',
        data: {
            filterProductPrice: filterName
        },
        success: function(data, status) {
            console.log(status);
            $('#displayDataTable').html(data);
        }
    });
}

//add product

function addproduct() {
    // $company_id = $_SESSION['company_id'];
    var nameAdd = $('#completename').val();
    var codeAdd = $('#completecode').val();
    var categoryAdd = $('#completecategory').val();
    var stockAdd = $('#completestock').val();
    var priceAdd = $('#completeprice').val();

    $.ajax({
        url: "insert.php",
        type: 'post',
        data: {
            nameSend: nameAdd,
            codeSend: codeAdd,
            categorySend: categoryAdd,
            stockSend: stockAdd,
            priceSend: priceAdd,
        },
        success: function(data, status) {
            //function to display data
            // console.log(status);
            $('#addProduct').modal('hide');
            displayData();
        }
    });
}

//delete product

function DeleteProduct(deleteid) {
    $.ajax({
        url: "delete.php",
        type: 'post',
        data: {
            deleteProduct: deleteid
        },
        success: function(data, success) {
            displayData();
        }
    });
}

//Edit product in table
function EditProduct(updateid) {
    $('#hiddendata').val(updateid);

    $.post("update.php", {
        updateProductid: updateid
    }, function(data, status) {
        var productid = JSON.parse(data);
        $('#updatename').val(productid.name);
        $('#updatecode').val(productid.code);
        $('#updatecategory').val(productid.category);
        $('#updatestock').val(productid.stock);
        $('#updateprice').val(productid.price);

    });


    $('#updateProduct').modal("show");

}

//Edit product details
function EditProductDetails() {
    var updatename = $('#updatename').val();
    var updatecode = $('#updatecode').val();
    var updatecategory = $('#updatecategory').val();
    var updatestock = $('#updatestock').val();
    var updateprice = $('#updateprice').val();
    var hiddendata = $('#hiddendata').val();

    $.post("update.php", {
        updatename: updatename,
        updatecode: updatecode,
        updatecategory: updatecategory,
        updatestock: updatestock,
        updateprice: updateprice,
        hiddendata: hiddendata
    }, function(data, status) {
        $('#updateProduct').modal('hide');
        displayData();

    });
}

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

//Search Product
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