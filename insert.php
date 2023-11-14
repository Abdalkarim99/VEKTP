<?php

require 'includes/database.php';
$conn = getDB();
session_start();

$error = "";
$company_id = $_SESSION['company_id'];

//ADD EMPLOYEE QUERY
extract($_POST); // $name=$_POST['name'];
if (!$nameSend) {
    $error .= "Name is required!";
}
if (!$phoneSend) {
    $error .= "phone is required";
}
if (!$roleSend) {
    $error .= "role is required!";
}
if (!$emailSend || filter_var($emailSend, FILTER_VALIDATE_EMAIL) === false) {
    $error .= "email is required!";
}
if ($error) {
    $error = "<b>There was an error in your form </b>" . $error;
} else {
    if (isset($_POST['nameSend']) && isset($_POST['phoneSend']) && isset($_POST['roleSend']) && isset($_POST['emailSend'])) {

        $sql = "INSERT INTO employees(name,phone,role,email,company_id)
                VALUES ('$nameSend','$phoneSend','$roleSend','$emailSend','$company_id')";

        $result = mysqli_query($conn, $sql);
    }
}


//ADD PRODUCT QUERY
$error = "";
extract($_POST);
if (!$_POST['nameSend']) {
    $error .= "Name is required!";
}
if (!$_POST['codeSend']) {
    $error .= "Code is required!";
}
if (!$_POST['categorySend']) {
    $error .= "Category is required!";
}
if (!$_POST['stockSend']) {
    $error .= "Stock is required!";
}
if (!$_POST['priceSend']) {
    $error .= "Price is required!";
}
if ($error) {
    $error = "<b>There was an error in your form </b>" . $error;
} else {
    if (isset($_POST['nameSend']) && isset($_POST['codeSend']) && isset($_POST['categorySend']) && isset($_POST['stockSend']) && isset($_POST['priceSend'])) {

        $sql = "INSERT INTO products(name,code,category,stock,price,company_id)
                VALUES ('$nameSend','$codeSend','$categorySend','$stockSend','$priceSend','$company_id')";

        $result = mysqli_query($conn, $sql);
    }
}

//ADD DOCUMENT QUERY
$error = "";
extract($_POST);

if (!$_POST['dateSend']) {
    $error .= "Date is required!";
}
if (!$_POST['referenceSend']) {
    $error .= "referenceNo is required!";
}
if (!$_POST['invoiceSend']) {
    $error .= "invoiceNo is required!";
}
if (!$_POST['paidSend']) {
    $error .= "paidBy is required!";
}
if (!$_POST['emailSend']) {
    $error .= "email is required!";
}
if (!$_POST['pdfSend']) {
    $error .= "PDF is required!";
}

if ($error) {
    $error = "<b>There was an error in your form </b>" . $error;
} else {
        // Save the PDF to the server
        $pdf_name = $pdfSend;
        $pdf_tmp = $_FILES['pdfSend']['tmp_name'];
        $pdf_path = "uploads/" . $pdf_name;
        move_uploaded_file($pdf_tmp, $pdf_path);

        // Insert the record into the database
        $sql = "INSERT INTO archives(date,referenceNo,invoiceNo,paidBy,email,pdf,company_id)
                VALUES ('$dateSend','$referenceSend','$invoiceSend','$paidSend','$emailSend','$pdf_path','$company_id')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Record added successfully!";
        } else {
            echo "Error adding record: " . mysqli_error($conn);
        }
}

mysqli_close($conn);
