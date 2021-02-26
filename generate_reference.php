<?php 
     include_once("connections/connection.php");


     
function random_strings($length_of_string) { 
       
    // random_bytes returns number of bytes 
    // bin2hex converts them into hexadecimal format 
    return substr(bin2hex(random_bytes($length_of_string)),  
                                      0, $length_of_string); 
        } 

        

?>