<?php
include('connection.php');
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');


$userId = $_REQUEST['id'];

$connection = new ConnectionModel();

if(!empty($userId)){

    $sql_e = "DELETE from register WHERE id='{$userId}'" ;
   
  if($connection->isConnected()->query($sql_e)==TRUE){

        $response['status']='success';
        $response['message']='Data deleted successfully';

    }else{
        $response['status']='Fail';
        $response['message']='Data do not deleted';
      
  }
    
}else {
    $response['status']='Fail';
    $response['message']='All field are required';
   
}

echo json_encode($response);
//mysqli_close($conn);  
?>