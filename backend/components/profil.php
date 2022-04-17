<?php
session_start();

if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:login.php');
}
 
include_once('../class/Crud.php');
 
$user = new Crud();

$msg1="";
$msg2="";
$msg3="";
$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
$row = $user->details($sql);
if($row>0){
    $img=$row['avatar'];
}

if(count($_POST)>0){
    $image =$_FILES['avatar']['name'];
    $userName=$user-> escape_string($_POST['userName']);
    $confirmPassword = md5($_POST['confirmPassword']);
    $newPassword = md5($_POST['newPassword']);
    $Password = md5($_POST['Password']);
    if($image){
        unlink('../Assets/Images/'.$image);
        move_uploaded_file($_FILES['avatar']['tmp_name'],'../Assets/Images/'.$image);
    }else{
        $image=$img;
    }
    $updateUser=$user->UpdateUserName($image,$userName);
    if($updateUser && empty($_POST['Password'])){
        header("location:profil.php");
    }else{
        if($Password === $row['Password']){
            if(!empty($_POST['confirmPassword']) && !empty($_POST['newPassword'])){
                if($confirmPassword === $newPassword){
                    $updatePassword=$user->UpdatePassword($confirmPassword);
                    if($updatePassword){
                            header("location:profil.php");
                        }
                }else{
                    $msg2="Password not match !";
                }
            }else{
                $msg3="Password should not be blank";
            }
            
        }else{
            $msg1="Wrong Password !";
        }
    }
    
    
    
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
    <nav class="navbar navbar-expand-lg navbar-light mb-0 border-bottom border-3 border-danger bg-danger px-5 fs-5 sticky-top " style="z-index:1080;" >
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
    <!------------------------------------Edit Profile-------------------------------->
    <div class="ProfilEdit" style="display:none; ">
    <div class ="bg-white d-flex flex-column align-items-center col-12 col-md-6 rounded-3 " style="position:absolute; z-index:1060;">
                    <a class="navbar-brand" href="index.php"><img src="../Assets/Images/logo2.png" class="mb-3 mt-3" alt="" style="width: 120px;"></a>
                    <form action="" class="p-4 align-self-start w-100" method="post" enctype="multipart/form-data">
                        <div class="mb-2 d-flex flex-column align-items-center justify-content-center position-relative">
                            <img id="avatar" src="../Assets/Images/<?php if(!empty($img)){echo $img;}else{echo'user.png';}?>" alt="" style="width:110px;height:110px; border-radius:100%">
                            <span  class="btn editpic border-0 py-1" style="position:absolute; top:75px; left:220px; background-color:#dcdcdb;">Edit</span>
                            <div class="editPIC flex-column mt-3 p-2 rounded-2" style="display:none;">
                                <span  style ="color:#dcdcdb; position:absolute; top:-30px; left:10px;"><i class="bi fs-3 bi-caret-up-fill"></i></span>
                                <a href="./components/deleteimg.php" class="btn deletpic btn-outline-primary border-0 px-1" style="font-size:12px;">Delete Picture</a>
                                <label for="file" class="form-label fw-bolder" ><span class="btn btn-outline-primary border-0 px-1" style="font-size:12px;">Upload New Picture</span></label>
                            </div>
                            <h3 class="text-center fw-bold text-primary mt-2">Edit Profile</h3>
                        </div>
                        <div class="mb-2 position-relative ">
                            <div class ="d-flex flex-column align-items-center">
                                <input type="file" class="form-control d-none fw-bolder" id="file"  name="avatar" >
                                <!-- <div class="d-flex">
                                    <span id="title" class="ms-2"></span>
                                    <i class="bi bi-x-circle-fill fs-6 ms-2 exclamation" id="invalidPic"></i>
                                    <i class="bi bi-check-circle-fill check ms-2" id="validPic"></i>
                                </div>
                                <div class="msg align-self-start" id="errorPicture"></div> -->
                            </div>
                            
                        </div>
                        
                        <div class="mb-2">
                            <label for="userName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="userName" name="userName" value ="<?php echo $row['userName']?>">
                        
                        </div>
                        <div class="mb-2">
                            <span id="editPassword" class="text-primary " style="cursor:pointer;">Edit Your Password</span>
                        </div>
                        <div class="mb-2 pass" style="display:none">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control " id="Password" name="Password" value="">
                            <span class ="text-danger"><?php echo $msg1?></span>
                        </div>
                        <div class="mb-2 pass" style="display:none">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name ="newPassword">
                            <span class ="text-danger"><?php echo $msg2; if( isset($_POST['newPassword']) && empty($_POST['newPassword'])){echo $msg3;}?></span>
                        </div>
                        <div class="mb-2 pass" style="display:none">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name ="confirmPassword">
                            <span class ="text-danger"><?php if(isset($_POST['confirmPassword']) && empty($_POST['confirmPassword'])){echo $msg3;}?></span>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary w-50 me-2 mb-2" id="update" name="update">Update</button>
                            <button type="reset" class="btn btn-danger w-50 mb-2" id="cancel" name="cancel">Cancel</button>
                        </div>
                    </form>
                </div>
    </div>
    <!--------------------------------------------------------------------------------->
    <!---------------------------------- Card ------------------------------------>
    <div class="card border-0 container d-flex justify-content-center align-items-center mt-5 " style="background-color:transparent;">
        <div class="d-flex flex-column align-items-center card-body bg-light text-dark fs-5 mx-0  rounded-3 h-100" >
            <h3 class="card-title text-center text-danger mb-4 fw-bolder">Welcome <?php echo $row['userName']?>!</h3>
            <button id="show" style = "background:transparent; border:none;"><img src="../Assets/Images/<?php if(!empty($img)){echo $img;}else{echo'user.png';}?>" alt="" style="width:85px;height:85px; border-radius:100%"></button>
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
        const modal = document.getElementsByTagName('body');
        const editModal = document.querySelector('.ProfilEdit');
        const editPass = document.querySelector('#editPassword');
        const editProfile = document.querySelector('#editProfile');
        const divPass = document.querySelectorAll('.pass');
        const passe = document.querySelector('#Password');
        const cancel = document.querySelector('#cancel');
        const editpic = document.querySelector('.editpic');
        const editPIC = document.querySelector('.editPIC');
        const deletePIC = document.querySelector('.deletpic');


            show.addEventListener("click",()=>{
                editModal.setAttribute("style","display:flex; justify-content:center; align-items:center; position:absolute; z-index:1060; background-color:rgba(0,0,0,0.5); width:100%; min-height:100vh;")
            });

            cancel.addEventListener("click",()=>{
                editModal.setAttribute("style","display:none;")
                for(let i=0; i<divPass.length; i++){
                    divPass[i].setAttribute("style","display:none;");
                }
            });

            editPass.addEventListener("click",()=>{
                editPass.setAttribute("style","display:none;");
                for(let i=0; i<divPass.length; i++){
                    divPass[i].removeAttribute("style","display:none;");
                }
            });
            editProfile.addEventListener("click",()=>{
                editModal.setAttribute("style","display:flex; justify-content:center; align-items:center; position:absolute; z-index:1060; background-color:rgba(0,0,0,0.5); width:100%; min-height:100vh;")
            });

            editpic.addEventListener("click",()=>{
                editPIC.setAttribute("style","display:flex; background-color:#dcdcdb; position:absolute; top:100px; left:220px;")
            });

            modal.addEventListener("click",()=>{
                editPIC.setAttribute("style","display:none;")
            });

    </script>
</body>
</html>