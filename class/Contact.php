<?php
    include_once'Crud.php';

    class Contact extends Crud{
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
     
            $sql = "SELECT * FROM contacliste WHERE Favoris= true AND id_user = '".$_SESSION['user']."' ORDER BY id ASC LIMIT $start_from, $limit";
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
     
            $sql = "SELECT * FROM contacliste  WHERE Favoris= true AND id_user = '".$_SESSION['user']."'";
            $query = $this->dbh->query($sql);
            $data = array();
            $message ="";
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_row()) {
                    $data[] = $row;
                }
                return $data;
            }else{
                $message ="No Favoris Yet";
                return $message;
            }      
        }
    
    
        public function countIDF(){
            $sql = "SELECT count(id) FROM contacliste WHERE Favoris = true AND id_user = '".$_SESSION['user']."'";
            $query = $this->dbh->query($sql);
            $row= mysqli_fetch_row($query);
            return $row;
        }
    
        public function displayRowFavoris($id){
     
            $sql = "SELECT id FROM contacliste WHERE Favoris = true  AND id_user = '".$_SESSION['user']."'";
            $query = $this->dbh->query($sql);
            $row = mysqli_fetch_row($query);
            return $row;
        }

        public function updateFavoris($Favoris,$id,$uId){
            $sql = "UPDATE contacliste SET Favoris='$Favoris' WHERE id='$id' AND id_user= '$uId'";
                $query = $this->dbh->query($sql);
                if ($query) {
                    return true;
                }else{
                    return false;
                }
        }
    
    }
    
?>