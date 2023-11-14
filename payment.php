<?php

use FontLib\Table\Type\head;

require 'auth.php';
require 'includes/database.php';
$conn = getDB();
session_start();
$company_id = $_SESSION['company_id'];

if (!isset($_SESSION['company_id'])) {
    header('Location: login.php'); // Redirect to login page
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $useage = date_create($_POST['useage']);
    $formatted_useage = date_format($useage, 'm/y');

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $useage = $_POST['useage'];
        $price = $_POST['price'];
        $payment_type = $_POST['payment_type'];
        $kart_number = $_POST['kart_number'];
        $date = $_POST['date'];
        $cvv = $_POST['cvv_code'];
        $note = $_POST['note'];

        if (empty($name) || empty($useage) || empty($price) || empty($payment_type) || empty($kart_number) || empty($date) || empty($cvv)) {
            $_SESSION['error_message'] = 'Lütfen bilgilerinizi doldurun';
            header('Location: payment.php');
            exit();
        } else {
            // Update database
            $sql = "INSERT INTO orders(name,useage_time,price,payment_type,card_number,date,cvv,note,company_id)
                    VALUES ('$name','$useage','$price','$payment_type','$kart_number','$date','$cvv','$note','$company_id')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $_SESSION['success_message'] = 'Ödeme lisansınız başarıyla güncellendi.';
                header('Location: payment.php');
                exit();
            }
        }
    }
}

?>

<?php require 'includes/header.php' ?>
<!-- Not:profile.css sayfasinda .box kodlari var  -->

<!DOCTYPE html>
<html>

<head>
    <title>Lisans Yenileme</title>
    <link rel="stylesheet" href="/css/profile.css">
</head>

<body>
    <div class="container my-5">
        <?php if (isset($_SESSION['success_message'])) : ?>
            <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_message'])) : ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
        <form class="box" id="form" method="post">
            <div>
                <h1>Lisans Yenileme</h1> <br><br>
            </div>
            <div class="row-md-9">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">İsim</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Kart üzerindeki isim">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="useage">Kullanım Süresi</label>
                            <input id="useage" name="useage" type="text" class="form-control" placeholder="mm/yy">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="price">Fiyat</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Örn: ***">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="payment_type">Ödeme Türü</label>
                            <select id="payment_type" name="payment_type" class="form-control">
                                <option selected>kart</option>
                                <option>vize</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kart_number">Kart Numarası</label>
                            <input type="text" name="kart_number" id="kart_number" class="form-control" placeholder="**** **** **** ****">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date">Tarih</label>
                            <input id="date" name="date" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cvv_code">CVV</label>
                            <input type="password" name="cvv_code" id="cvv_code" class="form-control" placeholder="***">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="note">Satın Alma Notu</label>
                            <textarea id="note" name="note" rows="5" cols="98" style="resize: none">

                        </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button id="update" name="update" class="btn btn-primary mt-3">Üyeliği Güncelle</button>
        </form>
    </div>


</body>


</html>