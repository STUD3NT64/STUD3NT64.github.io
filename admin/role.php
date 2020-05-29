<?php 
session_start();
include_once('../php/connect.php');
include("header_admin.php");
$url_full = basename($_SERVER['REQUEST_URI']);
if ($_GET['del']>0){
    mysqli_query($connect, "UPDATE `categori` SET `status` = 'del' WHERE `id` = '{$_GET['del']}'");
}
if ($_GET['repair']>0){
    mysqli_query($connect, "UPDATE `categori` SET `status` = 'ok' WHERE `id` = '{$_GET['repair']}'");
}
$url_array = explode("?",$url_full);
$url = $url_array[0];
$name=$_POST['element'];
if (isset($_POST['element']))
{
 mysqli_query($connect,"INSERT INTO `categori`(`name`, `url`) VALUES ('$name', '$url');");
}
?>
<div class="list-rang">
<div class="list-rang-all">
<h2>Создание новой роли</h2>
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="">
  <div class="form-group">
    <div class="col-sm-10">
      <input class="form-control" placeholder="Введите имя элемента" name="element">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Добавить</button>
    </div>
  </div>
</form>
<h2>Активные роли</h2>
<table class="table table-hover tablele">
    <thead>
    <tr>
        <th>№</th>
        <th>Роль</th>
        <th>Удалить</th>
    </tr>
        </thead>
        <tbody>
      <?php
      $data = mysqli_query($connect,"SELECT * FROM `categori` WHERE `url` = '$url' and `status` = 'ok' ");
      $cnt = 0;
      while($item = mysqli_fetch_assoc($data)){?>
      <tr>
        <td><?=++$cnt;?></td>
        <td><?=$item['name'];?></td>
        <td><a href="?del=<?=$item['id'];?>">Удалить</a></td>
      </tr>
       <?php
      }
      ?>
</tbody>
  </table>
  <h2>Удалённые роли</h2>
<table class="table table-hover tablele">
    <thead>
    <tr>
        <th>№</th>
        <th>Роль</th>
        <th>Восстановить</th>
    </tr>
        </thead>
        <tbody>
      <?php
      $data = mysqli_query($connect,"SELECT * FROM `categori` WHERE `url` = '$url' and `status` = 'del' ");
      $cnt = 0;
      while($item = mysqli_fetch_assoc($data)){?>
      <tr>
        <td><?=++$cnt;?></td>
        <td><?=$item['name'];?></td>
        <td><a href="?repair=<?=$item['id'];?>">Восстановить</a></td>
      </tr>
       <?php
      }
      ?>
      </div>
    </div>
</tbody>
  </table>