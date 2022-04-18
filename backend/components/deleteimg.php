<?php
session_start();
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:login.php');
}
include_once('../../class/Users.php');
$avatar= new Users();
$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
$row = $avatar->details($sql);
$imagename=$row['avatar'];
        if($imagename){
            unlink('../../Assets/Images/'.$imagename);
            $image="";
            $del = $avatar->deletePIC($image);
            header("location:../profil.php");
            echo"Deleted for success";
        }

        

