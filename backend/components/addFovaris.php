<?php
    session_start();

    if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
        header('location:../login.php');
    }

    include_once('../../class/Contact.php');
    $favoris = new Contact();
    if(isset($_GET['id'])){
        $Id=$_GET['id'];
    }
    $display = $favoris->displayConnect($Id);
    $rows = $favoris->displayRowFavoris($Id);
    $userID = $_SESSION['user'];
    $id = $display[0]['id'];
    $Name = $display[0]['Name'];
    $Phone = $display[0]['Phone'];
    $Email = $display[0]['Email'];
    $Address = $display[0]['Address'];

    print_r($rows);
    if(is_array($rows)){
            $ID=$rows[0];
            if($ID===$id){
                $fav=$favoris->updateFavoris(false,$id,$userID);
                header("location:../contactList.php");
            }else{
                $fav=$favoris->updateFavoris(true,$id,$userID);
                header("location:../contactList.php");
            }
        }
    else{
        $fav=$favoris->updateFavoris(true,$id,$userID);
        header("location:../contactList.php");
    }

    
    
?>