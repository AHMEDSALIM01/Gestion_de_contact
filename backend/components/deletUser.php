<?php
session_start();
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:login.php');
}
include_once('../../class/Users.php');
$user= new Users();
if($_GET['id']){
    $ID=$_GET['id'];
    $del = $user->deleteUser($_SESSION['user']);
    session_destroy();
	session_unset();
    header("location:../login.php");
}
