<?php

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
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set user property values

    $group -> name_group = $data-> name_group;
    $group -> description = $data-> description;
    $group ->  img_group= $data-> img_group;
    
//check if session open 
//if(isset($_SESSION['id_user'])){
    if(1==1){
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