<?php
session_start();
require 'includes/database.php';
$conn = getDB();

$email = "";
$errors = array();

if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Hata! Girdiğiniz şifreler eşleşmiyor!";
    } else {
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        // $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE companies SET code = $code, password = '$password' WHERE email = '$email'";
        $run_query = mysqli_query($conn, $update_pass);
        if ($run_query) {
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: login.php');
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}
?>
<?php
// $email = $_SESSION['email'];
// if($email == false){
//   header('Location: login.php');
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Yeni Şifre Oluştur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/forgot-password.css">
</head>

<body>
    <form action="new-password.php" method="POST" autocomplete="off">
        <h2 class="text-center">Yeni Şifre</h2>
        <p class="text-center">Yeni Şifrenizi Giriniz</p>
      
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
            <input class="form-control" type="password" name="password" placeholder="Yeni Şifre Oluşturunuz" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="cpassword" placeholder="Şifrenizi Doğrulayınız" required>
        </div>
        <div class="form-group">
            <input class="form-control button" type="submit" name="change-password" value="Değiştir">
        </div>
    </form>

</body>

</html>