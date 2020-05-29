<?php
session_start();
require_once("../vendor/connect.php");
include("includes/header.php");
if ($_GET['del']>0){
    mysqli_query($connect, "UPDATE `comments` SET `st` = 'del' WHERE `id` = '{$_GET['del']}'");
}
if ($_GET['repair']>0){
    mysqli_query($connect, "UPDATE `comments` SET `st` = 'ok' WHERE `id` = '{$_GET['repair']}'");
}
?>
<div class="container">
<div class="margin">
<h3>Активные записи</h3>
<table class="table table-hover">
    <thead>
    <tr>
        <th>№</th>
        <th>Логин</th>
        <th>Статус</th>
        <th>Комментарий</th>
        <th>Дата</th>
        <th>Удалить</th>
    </tr>
        </thead>
        <tbody>
      <?php
      $data = mysqli_query($connect,"SELECT * FROM `comments` WHERE `st` = 'ok' ");
      $cnt = 0;
      while($item = mysqli_fetch_assoc($data)){?>
      <tr>
        <td><?=++$cnt;?></td>
        <td><?=$item['login'];?></td>
        <td><?=$item['role'];?></td>
        <td><?=$item['descr'];?></td>
        <td><?=$item['date'];?></td>
        <td><a href="?del=<?=$item['id'];?>">Удалить</a></td>
      </tr>
       <?php
      }
      ?>
</tbody>
  </table>
  <h3>Удалённые записи</h3>
<table class="table table-hover">
    <thead>
    <tr>
        <th>№</th>
        <th>Логин</th>
        <th>Статус</th>
        <th>Комментарий</th>
        <th>Дата</th>
        <th>Восстановить</th>
    </tr>
        </thead>
        <tbody>
      <?php
      $data = mysqli_query($connect,"SELECT * FROM `comments` WHERE `st` = 'del' ");
      $cnt = 0;
      while($item = mysqli_fetch_assoc($data)){?>
      <tr>
        <td><?=++$cnt;?></td>
        <td><?=$item['login'];?></td>
        <td><?=$item['role'];?></td>
        <td><?=$item['descr'];?></td>
        <td><?=$item['date'];?></td>
        <td><a href="?repair=<?=$item['id'];?>">Восстановить</a></td>
      </tr>
       <?php
      }
      ?>
</tbody>
  </table>
</div>
</div>