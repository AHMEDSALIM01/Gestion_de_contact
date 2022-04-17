<?php
    session_start();

    if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
        header('location:../login.php');
    }

    include_once('../../class/Crud.php');
    $favoris = new Crud();
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
    // print_r($rows);
    if(is_array($rows)){
            $ID=$rows[0];
            if($ID===$id){
                $del = $favoris->deleteFavoris($_SESSION['user'],$ID);
                echo "<script>alert('Contact removed from favoris list');</script>";
                echo "<script>window.location.href='../contactList.php'</script>";
            }else{
                $sqlF = $favoris->addFavoris($userID,$id,$Name,$Phone,$Email,$Address);
                echo "<script>alert('Contact added to favoris list');</script>";
                if(!$sqlF){
                    echo "<script>alert('Something went wrong. Please try again');</script>";
                }
                echo "<script>window.location.href='../contactList.php'</script>";
            }
            
    }else{
        $sqlF = $favoris->addFavoris($userID,$id,$Name,$Phone,$Email,$Address);
        echo "<script>alert('Contact added to favoris list');</script>";
        if(!$sqlF){
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
        echo "<script>window.location.href='../contactList.php'</script>";
    }
    
    
?>