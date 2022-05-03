<?php
session_start();

if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:login.php');
}
 
include_once('../class/Users.php');
include_once('../class/Contact.php');
$sessionid=$_SESSION['user'];
$user = new Users();
$Contact = new Contact();

$msg1="";
$msg2="";
$msg3="";
$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
$row = $user->details($sql);
if($row>0){
    $img=$row['avatar'];
}

if(count($_POST)>0){
    $ext = substr($_FILES['avatar']['name'],strpos($_FILES['avatar']['name'],"."),strlen($_FILES['avatar']['name']));
    $image =str_replace($_FILES['avatar']['name'],$_FILES['avatar']['name'],$_SESSION['user'].$ext);
    $userName=$user-> escape_string($_POST['userName']);
    $confirmPassword = md5($_POST['confirmPassword']);
    $newPassword = md5($_POST['newPassword']);
    $Password = md5($_POST['Password']);
    if($image){
        if(file_exists('../Assets/Images/'.$image)){
            unlink('../Assets/Images/'.$image);
            move_uploaded_file($_FILES['avatar']['tmp_name'],'../Assets/Images/'.$image);
            header("location:profil.php");
        }else{
            move_uploaded_file($_FILES['avatar']['tmp_name'],'../Assets/Images/'.$image);
            header("location:profil.php");
        }
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

$records=$Contact->countID();
$Tfavoris=$Contact->countIDF();
// $rows = $user->displayFavoris();

$limit=4;
if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
    } 
    else{ 
    $page=1;
};  

$start_from = ($page-1) * $limit;
$rows = $Contact->displayFavorislimit($start_from,$limit);

$total_favoris = $Tfavoris[0];
$total_pages=ceil($total_favoris/$limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/CSS/my-bootstrap.css">
    <link rel="shortcut icon" type="image/png" href="../Assets/Images/Favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Profile</title>
</head>
<body class="vh-100 position-relative" style="font-family: 'Poppins', sans-serif;">
    <div class="mdldel justify-content-center align-items-center" style="display:none; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;">
        <div class ="confirmations row w-100 justify-content-center align-items-center" style="position:absolute; z-index:1060; display:none;">
            <div class ="d-flex flex-column align-items-center justify-content-center p-4 bg-white col-12 col-sm-8 col-md-6 col-lg-3 rounded-3" style="height:200px;">
                <h5 class="mb-5">Do you really want to delete your account ?</h5>
                <div>
                    <button class="Yesdel fs-5 me-3 btn btn-outline-danger"><span>Yes</span></button>
                    <button class="Nodel fs-5 btn btn-outline-primary"><span>No</span></button>
                </div>
            </div>
        </div>
    </div>
    <!---------------------------------- Navbar ---------------------------------->
    <nav class="navbar navbar-expand-lg navbar-light mb-0 border-bottom border-3 border-danger bg-danger px-5 fs-5" >
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
                            <a class="nav-link text-white mx-2"  href="profil.php"><?php echo $row['userName']?></a>
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
    <!------------------------------------------------------------------------------- -->
    <!---------------------------------- Card ------------------------------------>
    <div class=" border-0 " style="background-color:transparent;">
    <!---------------------------------- Profile ------------------------------------>
        <div class="row w-100" style="">
            <div class="col-12 col-md-4 p-5 d-flex justify-content-start align-items-center flex-column " style="">
                <button id="show" class="mb-4" style = "background:transparent; border:none;"><img src="../Assets/Images/<?php if(!empty($img)){echo $img;}else{echo'user.png';}?>" alt="" style="width:260px;height:260px; border-radius:100%"></button>
                <h6 class="mb-3 fw-bolder"><?php echo $row['userName']?></h6>
                <button type="submit" name="editProfile" id="editProfile" class="btn btn-danger mb-2">Edit your profile</button>
                <btn name="editProfile" id="deleteProfile" class="btn btn-outline-danger border-0" href="#./components/deletUser.php?id=<?php echo $_SESSION['user']; ?>">Delete your profile</btn>
                <div class="d-flex align-items-center mt-2">
                    <div class="d-flex align-items-center me-2"><i class="bi bi-star-fill fs-5 me-2" style="color:#fcd53f;"></i><span class="align-self-end" style="font-size:12px;"><?php echo $Tfavoris[0];?> Favoris</span></div>
                    <div class="d-flex align-items-center"><i class="bi fs-5 bi-person-lines-fill text-danger me-2"></i><span class="align-self-end" style="font-size:12px;"><?php echo $records[0];?> Contacts</span></div>
                </div>
            </div>
            <!------------------------------------Edit Profile-------------------------------->
            <div class ="bg-white ProfilEdit col-12 col-md-8  flex-column align-items-center" style="display:none;">
                            <form action="" class="p-4 align-self-start w-100" method="post" enctype="multipart/form-data">
                                <div class="mb-2 d-flex flex-column align-items-center justify-content-center position-relative">
                                    <img id="avatar" src="../Assets/Images/<?php if(!empty($img)){echo $img;}else{echo'user.png';}?>" alt="" style="width:110px;height:110px; border-radius:100%">
                                    <span  class="btn editpic border-0 py-1" style="position:absolute; top:75px; left:310px; background-color:#dcdcdb;">Edit</span>
                                    <div class="editPIC flex-column mt-3 p-2 rounded-2" style="display:none;">
                                        <span  style ="color:#dcdcdb; position:absolute; top:-25px; left:10px;"><i class="bi fs-3 bi-caret-up-fill"></i></span>
                                        <span  class="btn deletpic btn-outline-primary border-0 px-1" style="font-size:12px;">Delete Picture</span>
                                        <label for="file" class="form-label fw-bolder" ><span class="btn btn-outline-primary border-0 px-1" style="font-size:12px;">Upload New Picture</span></label>
                                    </div>
                                    <h3 class="text-center fw-bold text-primary mt-2">Edit Profile</h3>
                                </div>
                                <div class="mb-2 position-relative ">
                                    <div class ="d-flex flex-column align-items-center">
                                        <input type="file" class="form-control d-none fw-bolder" id="file"  name="avatar" >
                                        <input type="hidden" id="session" value="<?=$_SESSION['user'];?>">
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
    <!-- </div> -->
    <!--------------------------------------------------------------------------------->
    <!---------------------------------- Profile Info ------------------------------------>
            <div class="col-12 col-md-8 px-5">
                <div class="card pfInfo bg-light row mb-3  mt-md-4">
                        <div class="card-title">
                            <h3 class="text-danger fw-bold p-3">Profile Info</h3>
                        </div>
                        <div class="row">
                            <div class=" bg-light card border-0 col-sm-4 col-12 d-flex align-items-md-center align-items-start ms-3 ms-md-0">
                                <p class="fw-bold" style="font-size:20px;">User Name</p>
                                <p><?php echo $row['userName']?></p>
                                
                            </div>
                            <div class="bg-light card border-0 col-sm-4 col-12 d-flex align-items-md-center align-items-start ms-3 ms-md-0">
                                <p class="fw-bold" style="font-size:20px;">Signup Date</p>
                                <p><?php echo $row['time']?></p>
                            </div>
                            <div class="bg-light card border-0 col-sm-4 col-12 d-flex align-items-md-center align-items-start ms-3 ms-md-0">
                                <p class="fw-bold" style="font-size:20px;">Last Login</p>
                                <p><?php echo $_SESSION['time']?></p>
                            </div>
                        </div>
                </div>
    <!---------------------------------- Favoris Contact ------------------------------------>
                <div class="card row bg-light favcontact mb-0">
                    <div class="container table-responsive bg-light rounded-3 position-relative" style="font-size:11px">
                            <table class="table table-borderless table-light table-striped table-hover caption-top align-middle">
                                <caption class="p-3">
                                    <h3 class="text-danger fw-bold">Favoris Contact List</h3>
                                </caption>
                                    <?php 
                                        if(is_array($rows)){
                                    ?>
                                <thead>
                                    <tr>
                                    <td></td>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rows as $Row){
                                    ?>
                                    <tr class="idd" data-id ="<?=$Row['id'];?>">
                                    <td ><span class="nme border border-2 border-primary text-danger p-1" style="width:20px; height:20px; border-radius:100%;" ><?php echo strtoupper(substr($Row['Name'],0,2))?></span></td>
                                    <td class="tdN" data-target="<?=$Row['Name'];?>"><?php echo $Row['Name']?></td>
                                    <td class="tdE"  data-target="<?=$Row['Email'];?>"><?php echo $Row['Email']?></td>
                                    <td class="tdP"  data-target="<?=$Row['Phone'];?>"><?php echo $Row['Phone']?></td>
                                    <td class="tdA"  data-target="<?=$Row['Address'];?>"><?php echo $Row['Address']?></td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                            <?php if(!is_array($rows))
                                {
                            ?>
                            <h3 class="text-secondary text-center mb-4">No Favoris Contacts</h3>
                            <?php
                                }
                            ?>        
                    </div>
                    <?php
                            $pagLink = "<ul class='pagination d-flex justify-content-center mt-1'>";  
                            for ($i=1; $i<=$total_pages; $i++) {
                                $pagLink .= "<li class='page-item'><a class='page-link text-danger' href='profil.php?page=".$i."'>".$i."</a></li>";	
                            }
                            echo $pagLink . "</ul>";  
                    ?>
                </div>
            </div>
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
        const profileInfo = document.querySelector('.pfInfo');
        const favContact = document.querySelector('.favcontact');
        const file = document.querySelector('#file');
        const Delep = document.querySelector('#deleteProfile');
        const modalDel = document.querySelector(".mdldel");
        const delConf = document.querySelector(".confirmations");
        const Yesdel = document.querySelector(".Yesdel");
        const Nodel = document.querySelector(".Nodel");
        const Yes = document.querySelector(".Yes");
        const No = document.querySelector(".No");
        
        <?php echo "const image = '$img'" ?>

            show.addEventListener("click",()=>{
                editModal.setAttribute("style","display:flex; justify-content:center; ")
                profileInfo.setAttribute("style","display:none;");
                favContact.setAttribute("style","display:none;");
            });

            cancel.addEventListener("click",()=>{
                editModal.setAttribute("style","display:none;")
                for(let i=0; i<divPass.length; i++){
                    divPass[i].setAttribute("style","display:none;");
                }
                editPIC.setAttribute("style","display:none;")
                profileInfo.removeAttribute("style","display:none;");
                favContact.removeAttribute("style","display:none;");
                img.src="../Assets/Images/"+image;
            });

            editPass.addEventListener("click",()=>{
                editPass.setAttribute("style","display:none;");
                for(let i=0; i<divPass.length; i++){
                    divPass[i].removeAttribute("style","display:none;");
                }
            });
            editProfile.addEventListener("click",()=>{
                editModal.setAttribute("style","display:flex; justify-content:center; align-items:center;")
                profileInfo.setAttribute("style","display:none;");
                favContact.setAttribute("style","display:none;");
            });

            editpic.addEventListener("click",()=>{
                editPIC.setAttribute("style","display:flex; background-color:#dcdcdb; position:absolute; top:100px; left:300px;")
            });

            file.addEventListener("change", function() {
            const reader = new FileReader();
            reader.addEventListener("load", () => {
                const uploaded_image = reader.result;
                img.src = uploaded_image;
            });
            reader.readAsDataURL(this.files[0]);
            });

            Delep.addEventListener("click",()=>{
                modalDel.setAttribute("style","display:flex; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;");
                delConf.setAttribute("style","display:flex");
            });

            Yesdel.addEventListener("click",()=>{
                modalDel.setAttribute("style","display:none;");
                delConf.setAttribute("style","display:none;");
                window.location.href='./components/deletUser.php?id=<?php echo $_SESSION['user']?>';
            });

            Nodel.addEventListener("click",()=>{
                modalDel.setAttribute("style","display:none;");
                delConf.setAttribute("style","display:none;");
            });
                $(document).ready(function() {
                    $(document).on("click", ".deletpic", function() { 
                        if(image != ""){
                            $.ajax({
                                url: "./components/deleteimg.php",
                                type: "POST",
                                cache: false,
                                data:{ 
                                    id: $("session").val(),
                                },
                                success: function(data){
                                    $("body").html(data)
                                }
                            });
                        }
                    });
                });
            

    </script>
</body>
</html>