<?php 
    session_start();
    if (!$_SESSION['user']) {
        header('Location: index.php');
    }
?>

<!-- header menu -->
<?php require 'php_razmetka/header.php'; ?>
<!-- header menu -->

<!-- forceback -->
<?php require 'php_razmetka/forceback.php'; ?>
<!-- forceback -->

<!-- profile -->
<?php require 'php_razmetka/profile_html.php'; ?>
<!-- profile -->
<script src="https://unpkg.com/swiper/js/swiper.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>
    <script src="js/javascript.js" defer></script>
    <script src="js/jquery.maskedinput.min.js" defer></script>
</body>

</html>