<?php
require 'includes/database.php';
require 'auth.php';

session_start();

$conn = getDB();
?>


<?php require 'includes/header.php' ?>

<iframe src="http://localhost:8502/" width="1510px" height="2000px"></iframe>

<?php require 'includes/footer.php'?>

