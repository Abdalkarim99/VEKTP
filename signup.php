<?php
require 'url.php';
session_start();

$error = "";
if (array_key_exists("signup", $_POST)) {

    require 'includes/database.php';
    $conn = getDB();

    //Taking HTML Form Data from User
    // $id = mysqli_real_escape_string($conn,$_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $rol = mysqli_real_escape_string($conn,  $_POST['rol']);
    $company_name = mysqli_real_escape_string($conn,  $_POST['company_name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $password=mysqli_real_escape_string($conn,$_POST['password']);

    // PHP form validation PHP code
    if (!$name) {
        $error .= "İsim gerekli ";
    }
    if (!$surname) {
        $error .= "Soyisim gerekli ";
    }
    if (!$rol) {
        $error .= "Rol gerekli ";
    }
    if (!$company_name) {
        $error .= "Şirket İsmi gerekli ";
    }
    if (!$phone_number) {
        $error .= "Telefon gerekli ";
    }
    if (!$email || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $error .= "Mail gerekli ";
    }
    // if (!$password){
    //     $error .="password is required <br>";
    // }
    else {

        //Check if email is already exist in the Database

        $query = "SELECT id FROM companies WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $error .= "Bu mail zaten alınmış! ";
        } else {

            //Password encryption or Password Hashing
            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO companies (name, surname, rol, company_name, phone_number, email,password,code,status)
                                  VALUES('$name','$surname','$rol','$company_name','$phone_number','$email','$password','$code','$status')";

            if (!mysqli_query($conn, $query)) {
                $error = "Kaydını yapamadık. Lütfen tekrar dene. ";
            } else {
                //Redirecting user to home page after successfully logged in 
                // header("Location: login.php");
                redirect('/login.php');
            }
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
    <title>Kaydol</title>
    <link rel="stylesheet" href="/css/sign.css">


</head>

<body>
    <div><img src="/images/inventory pic.jpg" alt="Fotoğraf Görüntülenemiyor" class="bg_photo"></div>
    <div>
        <h1>Kaydol</h1>
        <div class="eclipse"></div>
        <img src="/images/add_user.png" alt="İkon Görüntülenemiyor" class="add_user_photo">
        <div class="form" id="signup">
            <form method="POST">
                <div class="error">
                    <?php
                    if ($error) {
                        echo "<script>alert('$error'); window.history.back();</script>";
                        exit();
                    }
                    ?>
                </div>

                <!--------- To check user regidtration status ------->

                <input type="text" name="name" placeholder="İsim" class="name_input">
                <input type="text" name="surname" placeholder="Soyisim" class="surname_input">
                <input type="text" name="rol" placeholder="Rol" class="role_input" class="role_input">
                <input type="text" name="company_name" placeholder="Şirket İsmi" class="company_input">
                <input type="text" name="phone_number" placeholder="Telefon Numarası" class="phone_input">
                <input type="email" name="email" placeholder="Mail Adresi" class="mail_input">
                <input type="submit" name="signup" value="Gönder" class="button">
                <p class="login">Zaten hesabım var: <a href="login.php">Giriş</a></p>
            </form>
        </div>
</body>

</html>