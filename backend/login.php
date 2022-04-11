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
                    <form action="profil.php" class="p-4 align-self-start w-100">
                        <div class="mb-3">
                            <h3 class="text-center fw-bold text-primary">Authenticate</h3>
                        </div>
                        <div class="mb-3">
                            <label for="userName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="userName">
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="Password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-5">Submit</button>
                        <p class="text-center">No account? <a href="signUp.php" class="text-decoration-none text-primary fw-bold">Sign Up</a> here</p>
                    </form>
                </div>
                <!--------------------------------------------------------------------------->
            </div>
        </div>
    <!---------------------------------------------------------------------------->    
    <script src="js/my-bootstrap.js"></script>
</body>
</html>