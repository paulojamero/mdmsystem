<?php 

function connection(){

    
        $host = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "mdmdb";
		$dbport ="";

        $con = new mysqli($host, $username, $password, $database);

        if($con -> connect_error) {

            echo $con->connect_error;
            
        } else {

            return $con;
        }

     
}



?>