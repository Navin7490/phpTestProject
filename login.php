<?php
include('connection.php');
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');




$email = $_REQUEST['email'];
$password =$_REQUEST['password'];

$connection = new ConnectionModel();

if(!empty($email) && !empty($password)){

    $sql_e = "SELECT * FROM register WHERE email='{$email}' AND password='{$password}'" ;
   $res= mysqli_query($connection->isConnected(),$sql_e);

   

    if(mysqli_num_rows($res)>0){

        $out_put= mysqli_fetch_all($res,MYSQLI_ASSOC);

        $response['data']=$out_put;
        $response['status']='success';
        $response['message']='Data feth successfully';

    }else{
        $response['status']='Fail';
        $response['message']='Invalid creadantial';
      
  }
    
}else {
    $response['status']='Fail';
    $response['message']='All field are required';
   
}

echo json_encode($response);
//mysqli_close($conn);  
?>