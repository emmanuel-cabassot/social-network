<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: *");
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

// setcomment property values

    $group -> id_group = $_POST['id_group'];
    $group -> id_user = $_POST['id_user'];
    $group -> text_comment= $_POST['text_comment'];
    $group -> date_comment =$_POST['date_comment'];
    
//check if session open 
if(isset($_SESSION['id_user'])){    
    $addComment = $group->addGroupComment();

    if($addComment){
     
    // set response code
    http_response_code(200);

    }else{
       
    // set response code
    http_response_code(503);

    } 
}else{http_response_code(406);}

?> 