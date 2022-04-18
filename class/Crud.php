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
    public function escape_string($value){
     
        return $this->dbh->real_escape_string($value);
    }

}

?>