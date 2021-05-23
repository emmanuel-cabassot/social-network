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
  
// instantiate group object
include_once '../models/Group.php';
  
$database = new Database();
$db = $database->getConnection();


// instantiate group object
$group = new Group($db);
 
// set ID property of record to 
$id_group = isset($_GET['id_group']) ? $_GET['id_group'] : die();
$id_user = $_SESSION['id_user'];

$belong = $group->belong($id_group, $id_user);

if($belong){
    http_response_code(200);
}
else{
    http_response_code(503);
}
