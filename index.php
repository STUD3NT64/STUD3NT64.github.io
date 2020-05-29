<?php 

session_start();
require_once 'php/connect.php';
if ($_SESSION['user']) {
    header('Location: profile.php');
}

?>
<!-- header menu -->
<?php require 'php_razmetka/header.php'; ?>
<!-- header menu -->

<!-- forceback -->
<?php require 'php_razmetka/forceback.php'; ?>
<!-- forceback -->
            
<!-- form register and login -->
<?php require 'php_razmetka/reg_log.php'; ?>
<!-- form register and login -->
    <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>
    <script src="js/logreg.js" defer></script>
    <script src="js/javascript.js" defer></script>
    <script src="js/jquery.maskedinput.min.js" defer></script>
</body>

</html>