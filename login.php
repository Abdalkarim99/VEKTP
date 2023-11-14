<?php
require 'url.php';

session_start();

$error = "";
if (array_key_exists("login", $_POST)) {

    require 'includes/database.php';
    $conn = getDB();

    //Taking form Data From User
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $password = mysqli_real_escape_string($conn,  $_POST['password']);

    //Check if input Field are empty
    if (!$id) {
        $error .= "ID girmediniz ";
    }
    if (!$password) {
        $error .= "Şifre girmediniz ";
    } else {
        //matching email and password

        $query = "SELECT * FROM companies WHERE id='$id' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);
            if ($row['id'] === $id && $row['password'] === $password) {
                $_SESSION['company_id'] = $row['id'];
                session_regenerate_id(true);
                $_SESSION['is_logged_in'] = true;
                redirect('/');
                exit();
            } else {
                $error = "ID ve Şifre eşleşmiyor, Lütfen yeniden deneyin ";
            }
        } else {
            $error = "ID ve Şifre eşleşmiyor, Lütfen yeniden deneyin ";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>
    <link rel="stylesheet" type="text/css" href="/css/login.css">
</head>


<body>
    <div><img src="/images/inventory pic.jpg" alt="Fotoğraf Görüntülenemiyor" class="bg_photo"></div>
    <div>
        <h1>Hoşgeldiniz</h1>
        <div class="eclipse"></div>
        <img src="/images/guest-64.png" alt="İkon Görüntülenemiyor" class="guest_photo">

        <div class="logInForm" id="login">
            <form method="POST">

                <!-- To show errors is user put wrong data -->
                <div class="error">
                    <?php
                    if ($error) {
                        echo "<script>alert('$error'); window.history.back();</script>";
                        exit();
                    }
                    ?>
                </div>

                <!-- To check the user loged In status -->
                <p>
                    <?php
                    if (!isset($_COOKIE["id"]) or !isset($_SESSION["id"])) {
                        echo "Giriş Yapın Lütfen";
                    }
                    ?>
                </p>
                <h3 class="user_id">Kullanıcı ID</h3>
                <input type="text" name="id" placeholder="Kullanıcı ID Giriniz" class="user_id_input">
                <h3 class="password">Şifre</h3>
                <input type="password" name="password" placeholder="Şifre Giriniz" class="password_input">
                <a href="forgot-password.php" class="forgot_password">Şifremi Unuttum?</a>
                <input type="submit" name="login" value="Giriş" class="button">
                <p class="signup">Hesabın yok mu: <a href="signup.php">Kaydol?</a></p>
            </form>
        </div>
    </div>

</body>

</html>