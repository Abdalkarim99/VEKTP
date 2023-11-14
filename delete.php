<?php

require 'includes/database.php';
$conn = getDB();

if(isset($_POST['deleteSend'])){
    $id=$_POST['deleteSend'];

    $sql = "DELETE FROM employees WHERE id=$id";
    $result = mysqli_query($conn,$sql);
}

//DELETE FROM INVENTORY PAGE
if(isset($_POST['deleteProduct'])){
    $id=$_POST['deleteProduct'];

    $sql = "DELETE FROM products WHERE id=$id";
    $result = mysqli_query($conn,$sql);
}

//DELETE FROM ARCHIVE PAGE

if(isset($_POST['deleteArchive'])){
    $id=$_POST['deleteArchive'];

    $sql = "DELETE FROM archives WHERE id=$id";
    $result = mysqli_query($conn,$sql);
}

?>