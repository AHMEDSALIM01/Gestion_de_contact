
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Profile</title>
</head>
<body class="vh-100" style="background-image:url('../Assets/Images/tile_background.png')">
    <!---------------------------------- Modal ---------------------------------->
    <div class="mdl justify-content-center align-items-center" style="display:none; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;">
                <div class ="confirmation row w-100 justify-content-center align-items-center" style="position:absolute; z-index:1060; display:none;">
                    <div class ="d-flex flex-column align-items-center justify-content-center p-4 bg-white col-12 col-sm-8 col-md-6 col-lg-3 rounded-3" style="height:200px;">
                        <h5 class="mb-5">Are you sure you want to delete this ?</h5>
                        <div>
                            <button class="Yes fs-5 me-3 btn btn-outline-danger"><span>Yes</span></button>
                            <button class="No fs-5 btn btn-outline-primary"><span>No</span></button>
                        </div>
                    </div>
                </div>
                <div class ="form row w-100 justify-content-center align-items-center" style="position:absolute; z-index:1060; display:flex;">
                    <form action="profil.php" class="p-4 bg-white col-12 col-sm-8 col-md-6 rounded-3" >
                        <div class="mb-3">
                            <h3 class="formTilte text-center fw-bold text-primary">Add Conatct</h3>
                        </div>
                        <div class ="d-flex">
                        <div class="mb-3 w-50 me-3">
                            <label for="Name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" id="Name">
                        </div>
                        <div class="mb-3 w-50">
                            <label for="Phone" class="form-label">Phone</label>
                            <input type="text" class="form-control shadow-none" id="Phone">
                        </div>
                        </div>
                        <div class="mb-3">
                            <label for="Email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" id="Email">
                        </div>
                        <div class="mb-3">
                            <label for="Address" class="form-label">Address</label>
                            <input type="text" class="form-control shadow-none" id="Address">
                        </div>
                        <div class="d-flex">
                            <input type="submit" class="save btn btn-primary w-50 me-3 mb-5 " name="save" value="Add">
                            <input type="reset" class="cancel btn btn-danger w-50 mb-5" name="cancel" value="cancel">
                        </div>
                    </form>
                </div>
    </div>
    <!---------------------------------------------------------------------------->
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
    
    <!---------------------------------- Contact Liste ---------------------------------->
    <div class="container table-responsive bg-light rounded-3 position-relative">
        <table class="table table-borderless table-light table-striped table-hover caption-top align-middle">
            <caption class="p-3">
                <h3 class="text-danger fw-bold">Contact List</h3>
            </caption>
            <thead>
                <tr>
                <td></td>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Tel</th>
                <th scope="col">Email</th>
                <td></td>
                <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td ><span class="bg-primary text-dark p-1" style="width:20px; height:20px; border-radius:100%;">AB</span></td>
                <td>Ahmed Salim</td>
                <td>Youssoufia Maroc</td>
                <td>0677889900</td>
                <td>salim@gmail.com</td>
                <td><i class="edit text-danger fs-5 bi bi-pen-fill " style="cursor:pointer;"></i></td>
                <td><i class="delete text-danger fs-5 bi bi-trash-fill" style="cursor:pointer;"></i></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <button class="add btn btn-primary text text-uppercase text-white my-3 px-3 py-2" id = "ADDNEW">
                <i class="fs-6 bi bi-plus-circle-fill"></i>
                <span>add new contact</span>
            </button>
        </div>
    </div>
    <!--------------------------------------------------------------------------------------------->
    <script src="js/my-bootstrap.js"></script>
    <script src="../Assets/JS/script.js"></script>
</body>
</html>