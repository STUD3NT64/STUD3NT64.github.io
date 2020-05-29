<?php

session_start();
require_once 'connect.php';

$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_2 = $_POST['password_2'];

$check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
if (mysqli_num_rows($check_login) > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "message1" => "Такой логин уже существует",
        "fields" => ['login']
    ];

    echo json_encode($response);
    die();
}

$check_email = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
if (mysqli_num_rows($check_email) > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "message1" => "Такой email уже существует",
        "fields" => ['email']
    ];

    echo json_encode($response);
    die();
}


$error_fields = [];

if ($login === '') {
    $error_fields[] = 'login';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_fields[] = 'email';
}

if ($password === '') {
    $error_fields[] = 'password';
}

if ($password_2 === '') {
    $error_fields[] = 'password_2';
}

if (!$_FILES['avatar']) {
    $error_fields[] = 'avatar';
}

if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message1" => "Проверьте правильность полей",
        "fields" => $error_fields
    ];

    echo json_encode($response);

    die();
}

if ($password === $password_2) {

    $path = 'uploads/' . time() . $_FILES['avatar']['name'];
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
        $response = [
            "status" => false,
            "type" => 2,
            "message1" => "Ошибка при загрузке аватарки",
        ];
        echo json_encode($response);
    }

    $password = md5($password);

    mysqli_query($connect, "INSERT INTO `users` (`id`, `login`, `email`, `password`, `avatar`) VALUES (NULL, '$login', '$email', '$password', '$path')");
        
    $response = [
        "status" => true,
        "message1" => "Регистрация прошла успешно!",
    ];
    echo json_encode($response);


} else {
    $response = [
        "status" => false,
        "message1" => "Пароли не совпадают",
    ];
    echo json_encode($response);
}

?>