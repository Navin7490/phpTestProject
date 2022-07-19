<?php

 
//echo 'Connected successfully';  
//mysqli_close($conn);  


class ConnectionModel {


  function isConnected(){
    $conn = mysqli_connect("127.0.0.1","root","","my_db");

    if(!$conn )  
    {  
      die('Could not connect: ' . mysqli_error());  
    } 
    
       return $conn;
  }


}

?>