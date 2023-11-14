<?php
session_start();
require 'includes/database.php';
$conn = getDB();

$email = "";
$errors = array();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $check_email = "SELECT * FROM companies WHERE email='$email'";
    $run_sql = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE companies SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($conn, $insert_code);
        if ($run_query) {
            require 'mail/PHPMailer-master/src/Exception.php';
            require 'mail/PHPMailer-master/src/PHPMailer.php';
            require 'mail/PHPMailer-master/src/SMTP.php';

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            // $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = 'kalt1660@gmail.com';
            $mail->Password = 'aiprahryaflznjra';
            $mail->setFrom('kalt1660@gmail.com');
            $mail->addAddress($email);
            $mail->Subject = "Password Reset Code";
            $mail->Body = "Your password reset code is $code";

            if ($mail->send()) {
                $info = "We've sent a password reset OTP to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "Bu Mail adresi bulunamadı!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Şifremi Unuttum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/forgot-password.css">
</head>

<body>
    <div class="box">
        <form action="forgot-password.php" method="POST" autocomplete="">
            <h2 class="text-center">Şifremi Unuttum</h2>
            <p class="text-center">Email Adresinizi Giriniz</p>
            <?php
            if (count($errors) > 0) {
            ?>
                <div class="alert alert-danger text-center">
                    <?php
                    foreach ($errors as $error) {
                        echo $error;
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email Adresi" required value="<?php echo $email ?>">
            </div>
            <div class="form-group">
                <input class="form-control button" type="submit" name="check-email" value="Devam Et">
            </div>
        </form>

    </div>
</body>

</html>