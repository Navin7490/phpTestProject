<?php
include('connection.php');
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');


$userId = $_REQUEST['id'];
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];


$connection = new ConnectionModel();


if(!empty($userId) && !empty($email) && !empty($name)){

    $sql_e = "UPDATE register SET name='{$name}',email='$email' WHERE id='{$userId}'" ;
   

    if($connection->isConnected()->query($sql_e)==TRUE){

        $response['status']='success';
        $response['message']='Data updated successfully';

    }else{
        $response['status']='Fail';
        $response['message']='Data do not updated';
      
  }
    
}else {
    $response['status']='Fail';
    $response['message']='All field are required';
   
}

echo json_encode($response);
//mysqli_close($conn);  
?>