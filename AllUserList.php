<?php
include('connection.php');
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');


$conn = new ConnectionModel();
    $sql_e = "SELECT * FROM register" ;
   // $token = bin2hex(random_bytes(16));
   $res= mysqli_query($conn->isConnected(),$sql_e);

  
    if(mysqli_num_rows($res)>0){

        $out_put= mysqli_fetch_all($res,MYSQLI_ASSOC);
        $response['data']=$out_put;
        $response['status']='success';
        $response['message']='Data feth successfully';

    }else{
        $response['status']='Fail';
        $response['message']='Invalid creadantial';
      
  }
    


echo json_encode($response);
//mysqli_close($conn);  
?>