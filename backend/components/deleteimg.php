<?php
session_start();
include_once('../../class/Crud.php');
$avatar= new Crud();
$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
$row = $avatar->details($sql);
$imagename=$row['avatar'];
        if($imagename){
            unlink('../../Assets/Images/'.$imagename);
            $image="";
            $del = $avatar->deletePIC($image);
            header("location:../profil.php");
        }
        

