<?php
    include_once('../../class/Crud.php');
    $UserName = new Crud();
    $uname = $_POST['userName'];
    $sql = $UserName->checkUser($uname);
    $num = mysqli_num_rows($sql);
    if($num > 0)
    {
    echo "<span style='color:red'> Username already associated with another account .</span>";
    echo "<script>$('#signUp').prop('disabled',true);</script>";
    } else{

    echo "<span style='color:green'> Unsername available for Registration .</span>";
    echo "<script>$('#signUp').prop('disabled',false);</script>";
    }
?>