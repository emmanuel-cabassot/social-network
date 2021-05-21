<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../models/Group.php';
  
$database = new Database();
$db = $database->getConnection();


// instantiate user object
$group = new Group($db);


// define absolute folder path
$dest_folder = 'assets/images/upload/groups/';

if (!empty($_FILES)) {
	
	// if dest folder doesen't exists, create it
	if(!file_exists($dest_folder) && !is_dir($dest_folder)) mkdir($dest_folder);
	
    $tempFile = $_FILES['file']['tmp_name'];        
    $targetFile =  $dest_folder . $_FILES['file']['name'];
    move_uploaded_file($tempFile,$targetFile);
}
 

// set user property values

    $group -> name_group = $_POST['name_group'];
    $group -> description = $_POST['description'];
    $group ->  img_group= $_POST['img_group'];
    $group -> id_user_create =$_SESSION['id_user'];
    
//check if session open 
if(isset($_SESSION['id_user'])){    
    $addGroup = $group->addGroup();
    
    if($addGroup){
    // set response code
    http_response_code(200);

    echo json_encode(
            array(
                "message" => "Ajout groupe réalisé.",
            )
        );
    }else{
       
    // set response code
    http_response_code(503);

    } 
}else{http_response_code(406);}

?>