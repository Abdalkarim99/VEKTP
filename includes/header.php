<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <?php if (isLoggedIn()) : ?>
        <header>
            <a href="index.php"><img class="logo" src="images/LOGO.jpg"></a>
            <nav class="navigation">
                <a href="index.php">Ana Sayfa</a>
                <a href="inventory.php">Envanter</a>
                <a href="employee.php">Çalışan Yönetimi</a>
                <a href="myapp.php">VEKTP Yapay Zeka</a>
                <a href="archive.php">Arşiv</a>
                <div class="dropdown">
                    <a href="profile.php" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/guest-64.png" class="icon">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profile.php">Profil</a></li>
                        <li><a class="dropdown-item" href="/payment.php">Lisans Yenileme</a></li>
                        <li><a class="dropdown-item" href="logout.php">Çıkış</a></li>
                    </ul>
                </div>
            </nav>
        </header>
    <?php else : ?>
        <p> Lütfen önce giriş yapın <a href="login.php">Giriş</a></p>
    <?php endif; ?>

    <div class="body">