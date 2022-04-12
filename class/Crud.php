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

    public function signUp($uname,$upassword){
        $ret = mysqli_query($this->dbh,"INSERT INTO users (userName,Password) VALUES('$uname','$upassword')");
        return $ret;
    }
    
    public function login($uname,$upassword){
        $result = mysqli_query($this->dbh,"SELECT * FROM users WHERE userName = '$uname' AND Password = '$upassword'");
        $num = mysqli_num_rows($result);
        if($num>0){
            $row = $result->fetch_assoc();
            return $row['id'];
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
    public function displayConnect(){
 
            $sql = "SELECT * FROM contacliste WHERE id_user = '".$_SESSION['user']."'";
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
}

?>