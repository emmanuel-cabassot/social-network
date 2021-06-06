<?php
session_start();
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
$forget = new Friend($db);

$id_follow = isset($_GET['id_follow']) ? $_GET['id_follow'] : die();
 
$forgeted = $forget->forgetFriend($id_follow);

if($forgeted){
// set response code - 200 OK
    http_response_code(200);
}  
else{
    // set response code - 503 
    http_response_code(503);

}