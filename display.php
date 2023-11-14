<?php
ini_set('display_errors', 0);
require 'includes/database.php';
$conn = getDB();
session_start();
$company_id = $_SESSION['company_id'];

//DISPLAY EMPLOYEE TABLE QUERY
if (isset($_POST['displaySend'])) {
  $table = '<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Sl No</th>
        <th scope="col" >İsim</th>
        <th scope="col" >Telefon</th>
        <th scope="col" >Rol</th>
        <th scope="col" >Mail</th>
        <th scope="col">İşlem</th>
      </tr>
    </thead>';

  $sql = "SELECT * FROM employees WHERE company_id='$company_id'";
  $result = mysqli_query($conn, $sql);
  $number = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $name = $row['name'];
    $phone = $row['phone'];
    $role = $row['role'];
    $email = $row['email'];

    $table .= '<tr>
        <td scope="row">' . $number . '</td>
        <td>' . $name . '</td>
        <td>' . $phone . '</td>
        <td>' . $role . '</td>
        <td>' . $email . '</td>
        <td>
            <button class="btn btn-dark" onclick="EditUser(' . $id . ')">Düzenle</button>
            <button class="btn btn-danger" onclick="DeleteUser(' . $id . ')">Sil</button>
        </td>
        </tr>';
    $number++;
  }
  $table .= '</table>';
  echo $table;
}

//DISPLAY PRODUCT TABLE QUERY
if (isset($_POST['displayProduct'])) {
  $table = '<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Sl No</th>
        <th scope="col" >Ürün Adı</th>
        <th scope="col" >Ürün Kodu</th>
        <th scope="col" >Ürün Kategorisi</th>
        <th scope="col" >Stok Sayısı</th>
        <th scope="col" >Ürün Fiyatı</th>
        <th scope="col">İşlem</th>
      </tr>
    </thead>';

  $sql = "SELECT * FROM products WHERE company_id='$company_id'";
  $result = mysqli_query($conn, $sql);
  $number = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $name = $row['name'];
    $code = $row['code'];
    $category = $row['category'];
    $stock = $row['stock'];
    $price = $row['price'];

    $table .= '<tr>
        <td scope="row">' . $number . '</td>
        <td>' . $name . '</td>
        <td>' . $code . '</td>
        <td>' . $category . '</td>
        <td>' . $stock . '</td>
        <td>' . $price . '</td>
        <td>
            <button class="btn btn-dark" onclick="EditProduct(' . $id . ')">Düzenle</button>
            <button class="btn btn-danger" onclick="DeleteProduct(' . $id . ')">Sil</button>
        </td>
        </tr>';
    $number++;
  }
  $table .= '</table>';
  echo $table;
}

//DISPLAY ARCHIVE TABLE QUERY

if (isset($_POST['displayArchive'])) {
  $table = '<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Sl No</th>
        <th scope="col" >Tarih</th>
        <th scope="col" >Referans Numarası</th>
        <th scope="col" >Fatura Numarası</th>
        <th scope="col" >Ödeme Yöntemi</th>
        <th scope="col" >Mail</th>
        <th scope="col">İşlem</th>
      </tr>
    </thead>';

  $sql = "SELECT * FROM archives WHERE company_id='$company_id'";
  $result = mysqli_query($conn, $sql);
  $number = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $date = $row['date'];
    $referenceNo = $row['referenceNo'];
    $invoiceNo = $row['invoiceNo'];
    $paidBy = $row['paidBy'];
    $email = $row['email'];
    $pdfPath = $row['pdf'];

    $table .= '<tr>
        <td scope="row">' . $number . '</td>
        <td>' . $date . '</td>
        <td>' . $referenceNo . '</td>
        <td>' . $invoiceNo . '</td>
        <td>' . $paidBy . '</td>
        <td>' . $email . '</td>
        <td>
        <a href="download.php?pdf=' . urlencode($pdfPath) . '"><img src="images/pdf.png" alt="PDF icon" width="15px"></a>
          <img src="images/delete.png" alt="Delete" onclick="DeleteArchive('. $id .')" <i class="fas fa-trash-alt"  width="15px"></i>
        </td>
        </tr>';
    $number++;
  }
  $table .= '</table>';
  echo $table;
}


//filterProductName

if (isset($_POST['filterProductName'])) {
  $table = '<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Sl No</th>
        <th scope="col" >Ad</th>
      </tr>
    </thead>';

  $sql = "SELECT name FROM products WHERE company_id='$company_id'";
  $result = mysqli_query($conn, $sql);
  $number = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];

    $table .= '<tr>
        <td scope="row">' . $number . '</td>
        <td>' . $name . '</td>
        </tr>';
    $number++;
  }
  $table .= '</table>';
  echo $table;
}

//filterProductCategory

if (isset($_POST['filterProductCategory'])) {
  $table = '<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Sl No</th>
        <th scope="col" >Kategori</th>
      </tr>
    </thead>';

  $sql = "SELECT category FROM products WHERE company_id='$company_id'";
  $result = mysqli_query($conn, $sql);
  $number = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $category = $row['category'];

    $table .= '<tr>
        <td scope="row">' . $number . '</td>
        <td>' . $category . '</td>
        </tr>';
    $number++;
  }
  $table .= '</table>';
  echo $table;
}

//filterProductPrice

if (isset($_POST['filterProductPrice'])) {
  $table = '<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Sl No</th>
        <th scope="col" >Fiayt</th>
      </tr>
    </thead>';

  $sql = "SELECT price FROM products WHERE company_id='$company_id'";
  $result = mysqli_query($conn, $sql);
  $number = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $price = $row['price'];

    $table .= '<tr>
        <td scope="row">' . $number . '</td>
        <td>' . $price . '</td>
        </tr>';
    $number++;
  }
  $table .= '</table>';
  echo $table;
}


//filter ReferenceNo in Archive page

if (isset($_POST['filterReferenceNo'])) {
  $table = '<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Sl No</th>
        <th scope="col" >Referans Numarası</th>
      </tr>
    </thead>';

  $sql = "SELECT referenceNo FROM archives WHERE company_id='$company_id'";
  $result = mysqli_query($conn, $sql);
  $number = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $referenceNo = $row['referenceNo'];

    $table .= '<tr>
        <td scope="row">' . $number . '</td>
        <td>' . $referenceNo . '</td>
        </tr>';
    $number++;
  }
  $table .= '</table>';
  echo $table;
}

//filter Email in Archive page

if (isset($_POST['filterEmail'])) {
  $table = '<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Sl No</th>
        <th scope="col" >Mail</th>
      </tr>
    </thead>';

  $sql = "SELECT email FROM archives WHERE company_id='$company_id'";
  $result = mysqli_query($conn, $sql);
  $number = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $email = $row['email'];

    $table .= '<tr>
        <td scope="row">' . $number . '</td>
        <td>' . $email . '</td>
        </tr>';
    $number++;
  }
  $table .= '</table>';
  echo $table;
}

//filter Date in Archive page

if (isset($_POST['filterDate'])) {
  $table = '<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">Sl No</th>
        <th scope="col" >Tarih</th>
      </tr>
    </thead>';

  $sql = "SELECT date FROM archives WHERE company_id='$company_id'";
  $result = mysqli_query($conn, $sql);
  $number = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    $date = $row['date'];

    $table .= '<tr>
        <td scope="row">' . $number . '</td>
        <td>' . $date . '</td>
        </tr>';
    $number++;
  }
  $table .= '</table>';
  echo $table;
}