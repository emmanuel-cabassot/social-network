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
include_once '../models/Event.php';
  
$database = new Database();
$db = $database->getConnection();


// instantiate user object
$event = new Event($db);

// setcomment property values

    $event -> id_event = $_POST['id_event'];
    $event -> id_user = $_POST['id_user'];
    $event -> text_comment= $_POST['text_comment'];
    $event -> date_comment =$_POST['date_comment'];
    
//check if session open 
if(isset($_SESSION['id_user'])){    
    $addComment = $event->addEventComment();

    if($addComment){
     
    // set response code
    http_response_code(200);

    }else{
       
    // set response code
    http_response_code(503);

    } 
}else{http_response_code(406);}

?> 