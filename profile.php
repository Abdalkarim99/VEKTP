<?php

use FontLib\Table\Type\head;

require 'auth.php';
require 'includes/database.php';
$conn = getDB();
session_start();
$id = $_SESSION['company_id'];

if (!isset($_SESSION['company_id'])) {
    header('Location: login.php'); // Redirect to login page
    exit;
}

// Retrieve current data from the database
$sql = "SELECT * FROM companies WHERE id=$id";
$result = mysqli_query($conn, $sql);
$current_data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Check if any data has changed
    if ($name == $current_data['name'] && $gender == $current_data['gender'] && $phone == $current_data['phone_Number'] && $role == $current_data['rol'] && $email == $current_data['email'] && $password == $current_data['password']) {
        $_SESSION['error_message'] = 'Bilgilerinizde herhangi bir değişiklik yapmadınız';
        header('Location: profile.php');
        exit();
    }
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['error_message'] = 'Lütfen bilgilerinizi doldurunuz';
            header('Location: profile.php');
            exit();
        } else {
            // Update database
            $sql = "UPDATE companies SET name='$name',gender='$gender',phone_Number='$phone',rol='$role',email='$email',password='$password' WHERE id=$id";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $_SESSION['success_message'] = 'Bilgileriniz başarıyla güncellendi.';
                header('Location: profile.php');
                exit();
            }
        }
    }
}

// Change Profile picture

if (isset($_FILES["profile_pic"]["name"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];

    $imageName = $_FILES["profile_pic"]["name"];
    $imageSize = $_FILES["profile_pic"]["size"];
    $tmpName = $_FILES["profile_pic"]["tmp_name"];

    //image Validation
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $imageName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)) {
        echo "
        <script>
            alert('Invalid Image Extension');
            document.location.href = '../profile.php';
        </script>
        ";
    } elseif ($imageSize > 1200000) {
        echo "
        <script>
            alert('Image Size is too large');
            document.location.href = '../profile.php';
        </script>
        ";
    } else {
        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa");
        $newImageName .= "." . $imageExtension;
        $query = "UPDATE companies SET profile_pic ='$newImageName'WHERE id =$id";
        mysqli_query($conn, $query);
        move_uploaded_file($tmpName, 'images/' . $newImageName);
        echo
        "
        <script>
            document.location.href = '../profile.php';
        </script>
        ";
    }
}

?>

<?php require 'includes/header.php' ?>
<!-- Not:profile.css sayfasinda .box kodlari var  -->

<!DOCTYPE html>
<html>

<head>
    <title>Profil</title>
    <link rel="stylesheet" href="/css/profile.css">
</head>

<style>
    .profile_btn {
        background-color: #0D6EFD;
        padding: 5px 10px;
        color: white;
        border-radius: 5px;
        margin-top: 10px;
        margin-bottom: 10px;

    }

    .profile_pic {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .img-fluid {
        border-radius: 50%;
        width: 170px;
        height: 170px;
        border: 2px solid #000000;
        margin-top: -10px;

    }

    label input[type="file"] {
        display: none;
    }
</style>

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
        <form class="box" id="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="row-md-3">
                    <div class="profile_pic">
                        <?php
                        $id = $current_data['id'];
                        $image = $current_data['profile_pic'];
                        ?>
                        <img src="/images/<?php echo $image ?>" class="img-fluid">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <label class="profile_btn">Fotoğrafı Değiştir<input type="file" id="profile_pic" accept=".jpg, .jpeg, .png" name="profile_pic"></label>
                    </div>
                </div>
                <div class="row-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">İsim</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Kullanıcı ismi" value="<?php echo $current_data['name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Cinsiyet</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option <?php if ($current_data['gender'] == 'Erkek') echo 'selected'; ?>>Erkek</option>
                                    <option <?php if ($current_data['gender'] == 'Kadın') echo 'selected'; ?>>Kadın</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="+90 *** *** ** **" value="<?php echo $current_data['phone_Number']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Rol</label>
                                <select id="role" name="role" class="form-control">
                                    <option <?php if ($current_data['rol'] == 'Admin') echo 'selected'; ?>>Admin</option>
                                    <option <?php if ($current_data['rol'] == 'User') echo 'selected'; ?>>User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="kullanıcı@gmail.com" value="<?php echo $current_data['email']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Şifre</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="******">
                            </div>
                        </div>
                    </div>
                    <button id="update" name="update" class="btn btn-primary mt-3">Güncelle</button>
                </div>
            </div>
        </form>
    </div>

    <script src="/js/profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>


</html>