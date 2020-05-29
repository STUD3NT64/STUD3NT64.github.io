<?php 
    session_start();
    require_once '../php/connect.php';
    $login = $_POST['login_com'];
    $descr = $_POST['comm'];
    $role = $_POST['roll'];
    mysqli_query($connect,"INSERT INTO `comments` (`id`,`login_com`, `descr`,`role`) VALUES (NULL,'$login', '$descr','$role');");
 ?>