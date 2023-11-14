<?php
require 'includes/database.php';
require 'auth.php';
require 'url.php';

session_start();

$conn = getDB();
?>


<?php require 'includes/header.php' ?>

<?php if (isLoggedIn()) : ?>
    <iframe src="http://localhost:8501/" width="1500px" height="1500px"></iframe>
<?php endif; ?>


<?php require 'includes/footer.php' ?>