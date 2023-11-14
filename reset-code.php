<?php
session_start();
require 'includes/database.php';
$conn = getDB();
$email = "";
$errors = array();

if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM companies WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Lütfen kodu giriniz";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "Yanlış kod girdiniz!";
    }
}
?>
<?php
// $email = $_SESSION['email'];
// if($email == false){ 
//   header('Location: login.php');
// }
// 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kod Doğrulama</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/forgot-password.css">
</head>

<body>

    <form action="reset-code.php" method="POST" autocomplete="off">
        <h2 class="text-center">Kod Doğrulama</h2>
        <p class="text-center">Kodunuzu Giriniz</p>
        <?php
        if (count($errors) > 0) {
        ?>
            <div class="alert alert-danger text-center">
                <?php
                foreach ($errors as $showerror) {
                    echo $showerror;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <div class="form-group">
            <input class="form-control" type="number" name="otp" placeholder="Kod" required>
        </div>
        <div class="form-group">
            <input class="form-control button" type="submit" name="check-reset-otp" value="Devam Et">
        </div>
    </form>


</body>

</html>