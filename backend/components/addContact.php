<?php
    session_start();

    if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
        header('location:login.php');
    }
    
    
    
    include_once('../../class/Contact.php');
        $contact = new Contact();
        // if(isset($_POST['save'])){
        $userID= $_SESSION['user'];
        $Name= $_POST['name'];
        $Phone= $_POST['phone'];
        $Email= $_POST['email'];
        $Address= $_POST['address'];
        $sqdl = $contact->addContact($userID,$Name,$Phone,$Email,$Address);
    // if($sqdl){
        if ($sqdl) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
    // }
?>