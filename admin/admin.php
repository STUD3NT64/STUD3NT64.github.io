<?php
session_start();
include_once('../php/connect.php');
include("header_admin.php");
if($_POST['user_id']>0)
{
    if (isset($_POST['status']))
    mysqli_query($connect,"UPDATE `users` SET `status` = '{$_POST['status']}' WHERE `id` = '{$_POST['user_id']}'");
    if (isset($_POST['role']))
    mysqli_query($connect,"UPDATE `users` SET `role` = '{$_POST['role']}' WHERE `id` = '{$_POST['user_id']}'");
}
$all_users = mysqli_query($connect,"SELECT * FROM `users`");
$cnt = 0;

if ($_GET['del']>0){
    mysqli_query($connect, "UPDATE `comments` SET `status` = 'del' WHERE `id` = '{$_GET['del']}'");
}
if ($_GET['repair']>0){
    mysqli_query($connect, "UPDATE `comments` SET `status` = 'ok' WHERE `id` = '{$_GET['repair']}'");
}
?>
<div class="margin">
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Аватарка</th>
                    <th>Логин</th>
                    <th>Ранг</th>
                    <th>Роль</th>
                </tr>
            </thead>
    <tbody>
<?php
 $all_statuses = mysqli_query($connect, "SELECT * FROM `categori` WHERE `status` = 'ok' and `url` = 'rang.php' ");
 $all_statuses_array = array();
        while($status = mysqli_fetch_assoc($all_statuses)){
            array_push($all_statuses_array,$status['name']);
        }
 $all_roles = mysqli_query($connect, "SELECT * FROM `categori` WHERE `status` = 'ok' and `url` = 'role.php' ");
 $all_roles_array = array();
    while($role = mysqli_fetch_assoc($all_roles)){
        array_push($all_roles_array, $role['name']);
        
    }

while($user = mysqli_fetch_assoc($all_users))
{?>
      <tr>
        <td><?=$user['id']?></td>
        <td><img src="../<?= $user['avatar']?>" style="border-radius: 100%"></td>
        <td><?=$user['login']?></td>
        <td>
        <form method="POST">
        <input type="hidden" name="user_id" value="<?=$user['id']?>">
        <select name='status' onchange='this.form.submit()'>
        <?php foreach($all_statuses_array as $status) {
            $selected = '';
        if($status==$user['status'])
        $selected = 'selected';
            
            ?>
        <option <?=$selected?>><?=$status?></option>
        <?php }?>
        </select>

        </form>
        </td>
        <td>
        <form method="POST">
        <input type="hidden" name="user_id" value="<?=$user['id']?>">
        <select name='role' onchange='this.form.submit()'> 
        <?php foreach($all_roles_array as $role) {
            
            $selected = '';
        if($role==$user['role'])
        $selected = 'selected';
            ?>
        <option <?=$selected?>><?=$role?></option>
        <?php }?>
        </select>
        </form>
        </td>
      </tr>
<?php
}
?>
</tbody>
  </table>
  </div>
  </div>
  <div class="comment">
  <div class="list-rang">
<div class="list-rang-all">
<h2>Активные комментарии</h2>
<table class="table table-hover tablele">
    <thead>
    <tr>
        <th>№</th>
        <th>Логин</th>
        <th>Текст</th>
        <th>Дата</th>
        <th>Удалить</th>
    </tr>
        </thead>
        <tbody>
      <?php
      $data = mysqli_query($connect,"SELECT * FROM `comments` WHERE `status` = 'ok' ");
      $cnt = 0;
      while($item = mysqli_fetch_assoc($data)){?>
      <tr>
        <td><?=++$cnt;?></td>
        <td><?=$item['login_com'];?></td>
        <td><?=$item['descr'];?></td>
        <td><?=$item['data'];?></td>
        <td><a href="?del=<?=$item['id'];?>">Удалить</a></td>
      </tr>
       <?php
      }
      ?>
</tbody>
  </table>
  <h2>Удалённые комментарии</h2>
<table class="table table-hover tablele">
    <thead>
    <tr>
        <th>№</th>
        <th>Логин</th>
        <th>Текст</th>
        <th>Дата</th>
        <th>Восстановить</th>
    </tr>
        </thead>
        <tbody>
      <?php
      $data = mysqli_query($connect,"SELECT * FROM `comments` WHERE `status` = 'del' ");
      $cnt = 0;
      while($item = mysqli_fetch_assoc($data)){?>
      <tr>
        <td><?=++$cnt;?></td>
        <td><?=$item['login'];?></td>
        <td><?=$item['descr'];?></td>
        <td><?=$item['data'];?></td>
        <td><a href="?repair=<?=$item['id'];?>">Восстановить</a></td>
      </tr>
       <?php
      }
      ?>
      </div>
      </div>
</tbody>
  </table>
  </div>