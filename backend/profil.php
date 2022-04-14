<?php
session_start();
$img="";
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:login.php');
}
 
include_once('../class/Crud.php');
 
$user = new Crud();
 

$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
$row = $user->details($sql);
if($row>0){
    $img=$row['avatar'];
}

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/CSS/my-bootstrap.css">
    <link rel="shortcut icon" type="image/png" href="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Profile</title>
</head>
<body class="vh-100 position-relative" style="background-image:url('../Assets/Images/tile_background.png');font-family: 'Poppins', sans-serif;">
    <!---------------------------------- Navbar ---------------------------------->
    <nav class="navbar navbar-expand-lg navbar-light mb-2 border-bottom border-3 border-danger bg-danger px-5 fs-5 sticky-top"  >
            <div class="container-sm container-fluid">
                <a class="navbar-brand" href="index.php"><img src="../Assets/Images/logo.png" alt="" style="width: 100px;"></a>
                <div class="d-flex flex-row align-items-center text-white">
                        <button class="navbar-toggler border-1" type="button"  data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list text-white fs-1 fw-bold"></i>
                        </button>
                </div>
                <div class="collapse  mt-sm-3 mt-lg-0 mb-0 navbar-collapse text-white" id="navbarText">
                    <ul class="navbar-nav ms-auto text-white  mb-0  align-items-center flex-column flex-md-row justify-content-end ">
                        <li class="nav-item d-flex justify-content-center me-3">
                            <a class="nav-link text-white mx-2"  href="profil.php"><?php echo $_SESSION['userName']?></a>
                        </li>
                        <li class="nav-item d-flex justify-content-center me-3">
                            <a class="nav-link text-white mx-2"  href="contactList.php">Contacts</a>
                        </li>
                        <li class="nav-item d-flex justify-content-center me-3">
                            <a class="nav-link text-white mx-2" href="./components/logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
    <div class="mdol" style="display:none ">
    <img id="avatar" src="../Assets/Images/<?php if(!empty($img)){echo $img;}else{echo'user';}?>.jpg" alt="" style="width:85px;height:85px; border-radius:100%">    
    </div>
    <!---------------------------------------------------------------------------->
    <!---------------------------------- Card ------------------------------------>
    <div class="card border-0 container d-flex justify-content-center align-items-center mt-5 " style="background-color:transparent;">
        <div class="d-flex flex-column align-items-center card-body bg-light text-dark fs-5 mx-0  rounded-3 h-100" >
            <h3 class="card-title text-center text-danger mb-4 fw-bolder">Welcome <?php echo $row['userName']?>!</h3>
            <button id="show" style = "background:transparent; border:none;"><img src="../Assets/Images/<?php if(!empty($img)){echo $img;}else{echo'user';}?>.jpg" alt="" style="width:85px;height:85px; border-radius:100%"></button>
            <button type="submit" name="editProfile" id="editProfile" class="btn btn-danger my-3">Edit your profile</button>
            <table class="table table-borderless table-light table-striped table-hover mt-0">
                <thead>
                    <tr>
                    <th scope="col">Your Profile : </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">User Name</th>
                    <td><?php echo $row['userName']?></td>
                    </tr>
                    <tr>
                    <th scope="row">SignupDate</th>
                    <td><?php echo $row['time']?></td>
                    </tr>
                    <tr>
                    <th scope="row">Last Login</th>
                <td><?php echo $_SESSION['time']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!---------------------------------------------------------------------------->    
    <script src="../Assets/JS/my-bootstrap.js"></script>
    <script>
        const img = document.querySelector('#avatar');
        const show = document.querySelector('#show');
        const modal = document.querySelector('.mdol');
        show.addEventListener("click",()=>{
            img.setAttribute("style","width:500px; position: absolute; border-radius:0px z-index:1060;");
            modal.setAttribute("style","display:flex; justify-content:center; align-items:center; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;")
        });
        modal.addEventListener("click",()=>{
            modal.setAttribute("style","display:none;")
        })

    </script>
</body>
</html>