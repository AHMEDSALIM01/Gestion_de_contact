<?php
define('servername','localhost');
define('username','root'); 
define('password' ,''); 
define('dbname', 'contact_db');
class Crud{

    public function __construct(){

            $connect = mysqli_connect(servername,username,password,dbname);
            $this->dbh=$connect;
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        
    }
    public function checkUser($uname){
        $result = mysqli_query($this->dbh,"SELECT userName FROM users WHERE userName = '$uname'");
        return $result;
    }

    public function UpdateUserName($image,$userName){
        $sql = "UPDATE users SET avatar='$image',userName='$userName'  WHERE id= '".$_SESSION['user']."'";
                $query = $this->dbh->query($sql);
                if ($query) {
                    return true;
                }else{
                    return false;
                }
            
    }

    public function deletePic($image){
        $sql = "UPDATE users SET avatar='$image'  WHERE id= '".$_SESSION['user']."'";
                $query = $this->dbh->query($sql);
                if ($query) {
                    return true;
                }else{
                    return false;
                }
            
    }

    public function UpdatePassword($Password){
        $sql = "UPDATE users SET Password='$Password'  WHERE id= '".$_SESSION['user']."'";
                $query = $this->dbh->query($sql);
                if ($query) {
                    return true;
                }else{
                    return false;
                }
            
    }

    public function signUp($uname,$upassword){
        $ret = mysqli_query($this->dbh,"INSERT INTO users (userName,Password) VALUES('$uname','$upassword')");
        return $ret;
    }
    
    public function login($uname,$upassword){
        $result = mysqli_query($this->dbh,"SELECT * FROM users WHERE userName = '$uname'");
        $num = mysqli_num_rows($result);
        if($num>0){
            $row = $result->fetch_assoc();
            if($upassword!==$row['Password']){
                return false;
            }else{
                return $row['id'];
            }
            
        }else{
            return false;
        }
    }

    public function escape_string($value){
 
        return $this->dbh->real_escape_string($value);
    }

    public function details($sql){
 
        $query = $this->dbh->query($sql);
 
        $row = $query->fetch_array();
 
        return $row;       
    }

    public function addContact($uId,$cName,$cPhone,$cEmail,$cAddress){
        $ret = mysqli_query($this->dbh,"INSERT INTO contacliste (id_user,Name,Phone,Email,Address) VALUES('$uId','$cName','$cPhone','$cEmail','$cAddress')");
        return $ret;
    }

    public function deleteContact($uId,$ID){
        $ret = "DELETE FROM contacliste WHERE id ='$ID' AND id_user='$uId'";
        $query = $this->dbh->query($ret);
        $data = array();
        if($query){
            return true;
        }else{
            return false;
        }
    }
    public function displayConnectLimit($start_from,$limit){
 
            $sql = "SELECT * FROM contacliste WHERE id_user = '".$_SESSION['user']."' ORDER BY id ASC LIMIT $start_from, $limit";
			$query = $this->dbh->query($sql);
			$data = array();
            $message ="";
			if ($query->num_rows > 0) {
				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			}else{
                $message ="No Contact Yet";
				return $message;
			}      
    }

    public function displayConnect($id){
 
        $sql = "SELECT * FROM contacliste WHERE id='$id' AND id_user = '".$_SESSION['user']."'";
        $query = $this->dbh->query($sql);
        $data = array();
        $message ="";
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }else{
            $message ="No Contact Yet";
            return $message;
        }      
}

    public function update($id,$uId,$cName,$cPhone,$cEmail,$cAddress){
            $sql = "UPDATE contacliste SET Name='$cName',Phone='$cPhone',Email='$cEmail',Address='$cAddress' WHERE id='$id' AND id_user= '$uId'";
                $query = $this->dbh->query($sql);
                if ($query) {
                    return true;
                }else{
                    return false;
                }
            }
    
    public function countID(){
        $sql = "SELECT count(id) FROM contacliste WHERE id_user = '".$_SESSION['user']."'";
        $query = $this->dbh->query($sql);
        $row= mysqli_fetch_row($query);
        return $row;
    }

    public function addFavoris($uId,$ID,$Fname,$Fphone,$Femail,$Faddress){
        $ret = mysqli_query($this->dbh,"INSERT INTO favorisListe (id_user,id_contact,Name,Phone,Email,Address) VALUES('$uId',$ID,'$Fname','$Fphone','$Femail','$Faddress')");
        return $ret;
    }

    public function displayFavorislimit($start_from,$limit){
 
        $sql = "SELECT * FROM favorisliste WHERE id_user = '".$_SESSION['user']."' ORDER BY id ASC LIMIT $start_from, $limit";
        $query = $this->dbh->query($sql);
        $data = array();
        $message ="";
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }else{
            $message ="No Favoris Yet";
            return $message;
        }      
    }

    public function displayFavoris(){
 
        $sql = "SELECT * FROM favorisliste WHERE id_user = '".$_SESSION['user']."'";
        $query = $this->dbh->query($sql);
        $data = array();
        $message ="";
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }else{
            $message ="No Favoris Yet";
            return $message;
        }      
    }

    public function deleteFavoris($uId,$ID){
        $ret = "DELETE FROM favorisliste WHERE id_contact='$ID' AND id_user='$uId'";
        $query = $this->dbh->query($ret);
        $data = array();
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function countIDF(){
        $sql = "SELECT count(id) FROM favorisliste WHERE id_user = '".$_SESSION['user']."'";
        $query = $this->dbh->query($sql);
        $row= mysqli_fetch_row($query);
        return $row;
    }

    // public function Sessionfav($favcontact_id){
    //     $_SESSION['id_contact'][1]=$favcontact_id;
    // }

    public function displayRowFavoris($id){
 
        $sql = "SELECT id_contact FROM favorisliste WHERE id_contact='$id' AND id_user = '".$_SESSION['user']."'";
        $query = $this->dbh->query($sql);
        $row = mysqli_fetch_row($query);
        return $row;
    }

}

?>