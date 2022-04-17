<?php
session_start();
include_once('../../class/Crud.php');
$favoris= new Crud();
$row = $favoris->displayFavoris();
$ID = $row[0]['id_contact'];
if($_GET['id']){
    $del = $favoris->deleteFavoris($_SESSION['user'],$ID);
    header("location:../profil.php");
}