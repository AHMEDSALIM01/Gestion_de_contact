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
<body class="vh-100" style="background-image:url('../Assets/Images/tile_background.png')">
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
                    <ul class="navbar-nav ms-auto text-white  mb-0  align-items-center flex-column flex-md-row justify-content-start ">
                        <li class="nav-item d-flex justify-content-center me-3">
                            <a class="nav-link text-white mx-2"  href="profil.php">Ahmed Salim</a>
                        </li>
                        <li class="nav-item d-flex justify-content-center me-3">
                            <a class="nav-link text-white mx-2"  href="contactList.php">Contacts</a>
                        </li>
                        <li class="nav-item d-flex justify-content-center me-3">
                            <a class="nav-link text-white mx-2" href="Logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
    <!---------------------------------------------------------------------------->
    <!---------------------------------- Card ------------------------------------>
        <div class="card border-0 container d-flex justify-content-center align-items-center mt-5 " style="background-color:transparent;">
            <div class="position-relative d-flex flex-column align-items-center card-body bg-light text-dark fs-5 mx-0  rounded-3 h-100" >
                <h1 class="card-title text-center text-danger mb-4 fw-bolder">Welcome !</h1>
                <img src="../Assets/Images/5-5us(1).JPG" alt="" style="width:85px;height:85px; border-radius:100% ">
                <label for="image" class ="text-secondary " style="position:absolute; top:135px; right:155px; cursor:pointer;"><i class="fs-4 bi bi-camera-fill"></i></label>
                <input type="file" name="image" id="image" style="visibility:hidden;">
                <table class="table table-borderless table-light table-striped table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Your Profile : </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">User Name</th>
                        <td>Ahmed Salim</td>
                        </tr>
                        <tr>
                        <th scope="row">SignupDate</th>
                        <td>Fri,08 Apr 2022 14:03:32</td>
                        </tr>
                        <tr>
                        <th scope="row">Last Login</th>
                        <td>Sun,09 Apr 2022 18:55:01</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <!---------------------------------------------------------------------------->    
    <script src="../Assets/JS/my-bootstrap.js"></script>
</body>
</html>