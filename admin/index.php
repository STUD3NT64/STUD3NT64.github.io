<?php
session_start();
include_once("../php/connect.php");
if (!$_SESSION['user']) {
    header('Location: ../index.php');
}
include("header_admin.php");
?>