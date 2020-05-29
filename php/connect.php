<?php 

    $connect = mysqli_connect('localhost', 'root', '', 'zonausers');

    if (!$connect) {
        die('Errors connect to DataBase');
    }

?>