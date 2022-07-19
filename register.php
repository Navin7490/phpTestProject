<?php
include('connection.php');
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
$target_dir="uplod/profileImage/";

//$data = json_decode( file_get_contents("php://input"),true);

//$data = json_decode($_POST["name"], false);
$name=$_REQUEST['name'];
$email = $_REQUEST['email'];
$password =$_REQUEST['password'];
$image = $_FILES['image']['tmp_name'];
$img = $_FILES['image'];
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$img = url()."".$target_file;

            var_dump($image);  

             if(!file_exists($target_dir)){
                mkdir($target_dir,0777,true);

             }
             move_uploaded_file($_FILES["image"]["tmp_name"], $target_file); 
  
$response['image']=$img;
$response['image2']=gethostbyname($_SERVER['SERVER_NAME']);



// $response['image2']=$_SERVER;

$connected = new ConnectionModel();

function url(){
    return sprintf(
      "%s://%s%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME'],
       '/'
    );
  }
echo json_encode($response); 
$table_sql="SHOW TABLES LIKE 'register'";
$result      = mysqli_query($connected->isConnected(),$table_sql);
$tableExists = mysqli_num_rows($result) > 0;

$sql = "CREATE TABLE register (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    password VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if($tableExists ==FALSE){
    if($connected->isConnected()->query($sql)==TRUE){
        $response['table']='table created'; 
       // insertData();
    }
}else{
    //insertData();  

    $registerModel= new RegisterModel(1,$name,$email,$password,$target_file);

   $registerModel->insertData($registerModel);
}




class RegisterModel {
     var $id;
     var $name;
     var $email;
     var $password;
     var $image;
    

    function __construct($id,$name,$email,$password,$image){

        $this->id=$id;
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
        $this->image=$image;
    

    }
   

    function insertData(RegisterModel $registerModel){


         $connected = new  ConnectionModel();




        if(!empty($registerModel->name) && !empty($registerModel->email) && !empty($registerModel->password)){
           
            
            $sql_e = "SELECT * FROM register WHERE email='{$registerModel->email}'" ;
            $res= mysqli_query($connected->isConnected(),$sql_e);
        
            if(mysqli_num_rows($res)>0){
                $response['status']='Fail';
                $response['message']='email already exist';
            }else{
        
                $sql = "INSERT INTO register (name,email,password,image ) VALUES ('{$registerModel->name}','{$registerModel->email}','{$registerModel->password}','{$registerModel->image}')";
        
                if($connected->isConnected() ->query($sql)==TRUE){
                   
                  // $response['data']=$_REQUEST;
                    $response['status']='Success';
                    $response['message']='Data inserted successfully';
            
                }else {
                    $response['status']='Fail';
                    $response['message']='something wrong';
               
                }
            }
    
        }else {
            $response['status']='Fail';
            $response['message']='All field are required';  
        }
    
        echo json_encode($response); 
      
    }
}



?>