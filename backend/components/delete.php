<?php
session_start();
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:login.php');
}
include_once('../../class/Contact.php');
$contact= new Contact();
if($_POST['id']){
    $ID=$_POST['id'];
    $del = $contact->deleteContact($_SESSION['user'],$ID);
    header("location:../contactList.php");
}