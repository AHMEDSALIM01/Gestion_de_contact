<?php
    session_start();
    if (isset($_SESSION['user'])){
        header('location:profil.php');
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
    <link rel="stylesheet" href="../Assets/CSS/style.css">
    <link rel="shortcut icon" type="image/png" href="">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>accueil</title>
</head>
<body class="vh-100" >
    <!---------------------------------- Navbar ---------------------------------->
    <div class="col-12">
    <nav class="navbar navbar-expand-lg navbar-light mb-2 border-bottom border-3 border-danger bg-danger px-5 fs-5 sticky-top"  >
            <div class="container-fluid ">
                    <a class="navbar-brand" href="index.php"><img src="../Assets/Images/logo.png" alt="" style="width: 100px;"></a>
                    <a class="nav-item text-white text-decoration-none" href="login.php">Login</a>
            </div>
    </nav>
    </div>
    <!---------------------------------------------------------------------------->
    <!---------------------------------- Container ------------------------------------>
        <div class="container d-flex align-items-center justify-content-center mt-5">
            <div class="row d-flex align-items-center justify-content-center">

            
            <div class="col-lg-5 col-12 ">
                <h1 class="text-danger mb-4 fw-bolder">Hello!</h1>
                <p class="fs-5 " >Contact is a unique and free online directory solution to centralize and manage all contacts (mobile phone, email, address).
                </p>
                <p class="fs-5 " >
                    get start creating your contact list for free.
                </p>
                <div>
                    <button class="btn btn-primary ">
                        <a href="signUp.php" class= "text-white text-decoration-none">Sign Up</a >
                    </button>
                </div>
            </div>
            <div class="col-lg-7 col-12 ps-4">
                <img src="../Assets/Images/Fichier 7@2x.png" alt="" style="width:90%">
            </div>
            </div>
        </div>
    <!---------------------------------------------------------------------------->    
    <script src="js/my-bootstrap.js"></script>
</body>
</html>