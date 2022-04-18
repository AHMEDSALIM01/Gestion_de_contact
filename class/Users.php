<?php
    include_once 'Crud.php';
    class Users extends Crud {
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

        public function deleteUser($uId){
            $ret = "DELETE FROM users WHERE id='$uId'";
            $query = $this->dbh->query($ret);
            $data = array();
            if($query){
                return true;
            }else{
                return false;
            }
        }
    }
?>