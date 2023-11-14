<?php

require 'includes/database.php';
$conn = getDB();

//THE EDIT BUTTON IN THE EMPLOYEE PAGE
if(isset($_POST['updateid'])){
    $id=$_POST['updateid'];

    $sql = "SELECT * FROM employees WHERE id=$id";
    $result = mysqli_query($conn,$sql);
    $response= array();
    while($row = mysqli_fetch_assoc($result)){
        $response = $row;
    }
    echo json_encode($response);  
}else{
    $response['status']=200;
    $response['message']="Invalid or data not found";
}

//THE EDIT BUTTON IN THE INVENTORY PAGE
if(isset($_POST['updateProductid'])){
    $id=$_POST['updateProductid'];

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($conn,$sql);
    $response= array();
    while($row = mysqli_fetch_assoc($result)){
        $response = $row;
    }
    echo json_encode($response);  
}else{
    $response['status']=200;
    $response['message']="Invalid or data not found";
}


//Edit(update,change) users details 
if(isset($_POST['hiddendata'])){
    $id=$_POST['hiddendata'];
    $name=$_POST['updatename'];
    $phone=$_POST['updatephone'];
    $role=$_POST['updaterole'];
    $email=$_POST['updatemail'];

    $sql ="UPDATE employees SET name='$name',phone='$phone',role='$role',email='$email' WHERE id=$id";
    $result =mysqli_query($conn,$sql);
}

//Edit(update,change) Product details 
if(isset($_POST['hiddendata'])){
    $id=$_POST['hiddendata'];
    $name=$_POST['updatename'];
    $code=$_POST['updatecode'];
    $category=$_POST['updatecategory'];
    $stock=$_POST['updatestock'];
    $price=$_POST['updateprice'];

    $sql ="UPDATE products SET name='$name',code='$code',category='$category',stock='$stock',price='$price' WHERE id=$id";
    $result =mysqli_query($conn,$sql);
}

?>