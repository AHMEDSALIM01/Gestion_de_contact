<?php
session_start();
include_once('../../class/Crud.php');
$contact= new Crud();
if($_GET['id']){
    $ID=$_GET['id'];
    $del = $contact->deleteContact($_SESSION['user'],$ID);
    header("location:../contactList.php");
}