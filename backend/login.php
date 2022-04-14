<?php

session_start();
$message="";
if (isset($_SESSION['user'])){
    header('location:profil.php');
}

include_once('../class/Crud.php');
$user = new Crud();
if(isset($_POST['Login'])){
	$username = $user->escape_string($_POST['userName']);
	$password = $user->escape_string(md5($_POST['Password']));
 
	$auth = $user->login($username, $password);

 
	if(!$auth){
        $message="Invalid password or email !";
	}
	else{
		$_SESSION['user'] = $auth;
        $_SESSION['time'] = date("Y-m-d H:i:s");
        $_SESSION['userName'] = $username;
		header('location:profil.php');
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
    <title>Login</title>
</head>
<body class="vh-100 bg-white" style="background-image:url('../Assets/Images/tile_background.png')">
    <!---------------------------------- container ------------------------------------>
        <div class="container" >
            <div class="row d-flex justify-content-center align-items-center vh-100">
                <!---------------------------------- Image ------------------------------------>
                <div class="col-12 col-md-6  d-none rounded-3 d-md-block">
                    <img src="../Assets/Images/undraw_access_account_re_8spm.svg" alt="" style="width:clamp(350px,90%,500px)">
                </div>
                <!---------------------------------------------------------------------------->
                <!---------------------------------- form ------------------------------------>
                <div class ="bg-white d-flex flex-column align-items-center col-12 col-md-6 rounded-3 ">
                    <a class="navbar-brand" href="index.php"><img src="../Assets/Images/logo2.png" class="mb-3 mt-3" alt="" style="width: 120px;"></a>
                    <form  class="p-4 align-self-start w-100" method="post">
                        <div class="mb-3">
                            <h3 class="text-center fw-bold text-primary">Authenticate</h3>
                        </div>
                        <div class="errormsg"></div>
                        <div class="mb-3">
                            <label for="userName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="userName" name="userName" value="<?php if(isset($username)){echo $username;}else{echo "";}?>">
                            <span id="usernameavailblty" class="text-danger"><?php echo $message;?></span>
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="Password" name="Password">
                            <span id="checkpassword" class="text-danger"></span>
                        </div>
                        <input type="submit" class="btn btn-primary w-100 mb-5" id="Login" name="Login" value="Login">
                        <p class="text-center">No account? <a href="signUp.php" class="text-decoration-none text-primary fw-bold">Sign Up</a> here</p>
                    </form>
                </div>
                <!--------------------------------------------------------------------------->
            </div>
        </div>
    <!---------------------------------------------------------------------------->    
    <script src="../Assets/JS/my-bootstrap.js"></script>
    <script>
        const username = document.querySelector("#userName");
        const password = document.querySelector("#Password");
        const checkmsg = document.querySelector("#usernameavailblty");
        const checkpass = document.querySelector("#checkpassword");
        const btnLogin = document.querySelector("#Login");
        
        btnLogin.addEventListener("click", (e)=>{
            if(username.value=="" || password.value==""){
                e.preventDefault();
                checkmsg.innerText = (username.value === "") ? "UserName is Required" : "";
                checkpass.innerText =(Password.value === "") ? "Password is Required" : "";
            }
        });

    </script>
</body>
</html>