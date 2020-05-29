<!-- <?php
$to = "stud3nt2k@gmail.com"; // емайл получателя данных из формы
$tema = "Заявка на бронь"; // тема полученного емайла
$message = "Количество мест: ".$_POST['mesta']."<br>";//присвоить переменной значение, полученное из формы name=name
  $message .= "Время и дата визита: ".$_POST['data_time']."<br>"; //полученное из формы name=email
$message .= "ФИО: ".$_POST['FIO']."<br>"; //полученное из формы name=phone
$message .= "Номер телефона: ".$_POST['telephone']."<br>"; //полученное из формы name=message
$headers  = 'MIME-Version: 1.0' . "\r\n"; // заголовок соответствует формату плюс символ перевода строки
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // указывает на тип посылаемого контента
mail($to, $tema, $message, $headers); //отправляет получателю на емайл значения переменных
?> -->


<?php

// Получаем значения переменных из пришедших данных

$mesta = $_POST['mesta'];

$data_time = $_POST['data_time'];

$FIO = $_POST['FIO'];

$telephone = $_POST['telephone'];

 
// Формируем сообщение для отправки, в нём мы соберём всё, что ввели в форме 

$mes = "Имя: $mesta \nE-mail: $data_time \nТема: $FIO \nТекст: $telephone";

 
// Пытаемся отправить письмо по заданному адресу

// Если нужно, чтобы письма всё время уходили на ваш адрес — замените первую переменную $email на свой адрес электронной почты

$email = "stud3nt2k@gmail.com";

$send = mail ($email,$mes,"Content-type:text/plain; charset = UTF-8\r\nFrom:$email");
// Если отправка прошла успешно — так и пишем 


if ($send == 'true')

{echo "Сообщение отправлено";}
// Если письмо не ушло — выводим сообщение об ошибке

else {echo "Ой, что-то пошло не так";}

?>