<?php
session_start();

if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:login.php');
}



include_once('../class/Contact.php');
$contact = new Contact();

if(isset($_POST['Update']))
    {
        $id = $_POST['id'];
        $uid=$_SESSION['user'];
        $Name = $_POST['Name'];
        $Phone = $_POST['Phone'];
        $Email = $_POST['Email'];
        $Address = $_POST['Address'];
        echo $_POST['Name'];
        $sql=$contact->update($id,$uid,$Name, $Phone,$Email,$Address);
        if($sql)
        {
            echo "<script>alert('Contact Edited successfully.');</script>";
            echo "<script>window.location.href='contactList.php'</script>";
        }else{
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
    }

if(isset($_POST['save'])){
    $userID= $_SESSION['user'];
    $Name= $_POST['Name'];
    $Phone= $_POST['Phone'];
    $Email= $_POST['Email'];
    $Address= $_POST['Address'];
    $sqdl = $contact->addContact($userID,$Name,$Phone,$Email,$Address);
    if($sqdl){
        echo "<script>alert('Contact Added successfully.');</script>";
        echo "<script>window.location.href='contactList.php'</script>";
    }else{
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}

$limit=5;
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
};  
$start_from = ($page-1) * $limit;
$row = $contact->displayConnectLimit($start_from,$limit);

$records=$contact->countID();
$total_records = $records[0];
$total_pages=ceil($total_records/$limit);


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
    <link rel="shortcut icon" type="image/png" href="../Assets/Images/Favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Contact List</title>
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
                    <form action="" class="p-4 bg-white col-12 col-sm-8 col-md-6 rounded-3" method="post">
                        <div class="mb-3">
                            <h3 class="formTilte text-center fw-bold text-primary">Add Conatct</h3>
                        </div>
                        <div class ="d-flex">
                        <div class="mb-3 w-50 me-3">
                            <label for="Name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" class=" form-control shadow-none" id="Name" name="Name" value ="">
                            <div class="msg" id="errorNp" for="name"></div>
                        </div>
                        <div class="mb-3 w-50">
                            <label for="Phone" class="form-label">Phone</label>
                            <input type="text" class="form-control shadow-none" id="Phone" name="Phone" value ="">
                            <div class="msg" id="error" for="Email"></div>
                        </div>
                        </div>
                        <div class="mb-3">
                            <label for="Email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" id="Email" name="Email" value ="">
                            <div class="msg" id="error" for="Email"></div>
                        </div>
                        <div class="mb-3">
                            <label for="Address" class="form-label">Address</label>
                            <input type="text" class="form-control shadow-none" id="Address" name="Address" value ="">
                            <div class="msg" id="error" for="Email"></div>
                        </div>
                        <input type="hidden" class="form-control shadow-none" id="id" name="id" value ="">
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
                            <a class="nav-link text-white mx-2"  href="profil.php"><?php echo $_SESSION['userName']?></a>
                        </li>
                        <li class="nav-item d-flex justify-content-center me-3">
                            <a class="nav-link text-white mx-2"  href="contactList.php">Contacts</a>
                        </li>
                        <li class="nav-item d-flex justify-content-center me-3">
                            <a class="nav-link text-white mx-2" href="../backend/components/logout.php">Logout</a>
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
                <?php 
                    if(is_array($row)){
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
                <?php foreach ($row as $row){
                ?>
                <tr class="idd" data-id="<?=$row['id'];?>">
                <td ><span class="nme border border-2 border-primary text-danger p-1" style="width:20px; height:20px; border-radius:100%;" ><?php echo strtoupper(substr($row['Name'],0,2))?></span></td>
                <td class="tdN" data-target="<?=$row['Name'];?>"><?php echo $row['Name']?></td>
                <td class="tdE"  data-target="<?=$row['Email'];?>"><?php echo $row['Email']?></td>
                <td class="tdP"  data-target="<?=$row['Phone'];?>"><?php echo $row['Phone']?></td>
                <td class="tdA"  data-target="<?=$row['Address'];?>"><?php echo $row['Address']?></td>
                <td><i class="edit text-danger fs-6 bi bi-pen-fill " style="cursor:pointer;"></i></td>
                <td><i class="delete text-danger fs-6 bi bi-trash-fill" style="cursor:pointer;"></i></td>
                <td class="Favoris"><a class="addfav text-decoration-none" href="./components/addFovaris.php?id=<?php echo $row['id'];?>"><i class="bi text-danger fs-5 bi-star" style ="<?php if($row['Favoris']==true){echo"display:none;" ;} ?>"></i><i class="bi fs-5 bi-star-fill" style="<?php if($row['Favoris']==true){echo "display:inline;";}else{echo"display:none;";} ?>;color:#fcd53f;"></i></a></td>
                <input type="hidden" id="inp" value="<?=$row['id'];?>">
                </tr>
                <?php }}?>
            </tbody>
        </table>
        <?php if(!is_array($row))
            {
        ?>
        <h3 class="text-secondary text-center">No Contacts</h3>
        <?php
            }
        ?>
        <div class="d-flex justify-content-center">
            <button class="add btn btn-primary text text-uppercase text-white mt-1 mb-3 px-3 py-2" id = "ADDNEW">
                <i class="fs-6 bi bi-plus-circle-fill"></i>
                <span>add new contact</span>
            </button>
        </div>
        
    </div>
    <?php
            $pagLink = "<ul class='pagination d-flex justify-content-center mt-4'>";  
            for ($i=1; $i<=$total_pages; $i++) {
                $pagLink .= "<li class='page-item'><a class='page-link text-danger' href='contactList.php?page=".$i."'>".$i."</a></li>";	
            }
            echo $pagLink . "</ul>";  
    ?>
    <!--------------------------------------------------------------------------------------------->
    <script src="../Assets/JS/my-bootstrap.js"></script>
    <script src="../Assets/JS/script.js"></script>
    <script>
        const Favfill = document.querySelectorAll('.Favorisfill');
        const addFav = document.querySelectorAll('.addfav');
        const removeFav = document.querySelectorAll('.removefav');
        const tdd = document.querySelectorAll('.idd');
        
    $(document).ready(function() {
        $(document).on("click", ".delete", function() { 
            $.ajax({
                url: "./components/delete.php",
                type: "POST",
                cache: false,
                data:{ 
                    id: $("#inp").val(),
                },
                success: function(data){
                    $("body").html(data)
                }
            });
        });
    });

    $(document).ready(function() {
        $(document).on("click", ".delete", function() { 
            $.ajax({
                url: "./components/delete.php",
                type: "POST",
                cache: false,
                data:{ 
                    id: $("#inp").val(),
                },
                success: function(data){
                    $("body").html(data)
                }
            });
        });
    });


        // Yes.addEventListener("click",()=>{
        //     modal.setAttribute("style","display:none;");
        //     form.setAttribute("style","display:flex;");
        //     confirmation.setAttribute("style","display:none;");
        //     window.location.href='./components/delete.php?id=<?php echo $row['id']?>';
        // });
    

       
        
        
    </script>
</body>
</html>