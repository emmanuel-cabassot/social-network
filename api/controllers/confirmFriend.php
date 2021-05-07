<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../models/Friend.php';
  
$database = new Database();
$db = $database->getConnection();


// instantiate user object
$confirm = new Friend($db);

$confirm->id_friend = isset($_GET['id_friend']) ? $_GET['id_friend'] : die();
 
$confirmed = $confirm->confirmFriend($id_friend);

if($confirmed){
// set response code - 200 OK
    http_response_code(200);
}  
else{
    // set response code - 503 
    http_response_code(503);

}