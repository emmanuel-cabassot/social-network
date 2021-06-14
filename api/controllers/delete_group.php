<?php
// required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  
// include database and object files
include_once '../config/database.php';
include_once '../models/Group.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$group = new Group($db);
  
// set ID property of record to read

$group->id_group = isset($_GET['id_group']) ? $_GET['id_group'] : die();
  
if($group->delete_group($group->id_group)){

    http_response_code(200);  
}
else{
    http_response_code(503);  
}

