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

// instantiate event object
include_once '../models/Group.php';


// instantiate database and event object
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$partGroup = new Group($db);

$id_user = $_SESSION['id_user'];
$id_group = isset($_GET['id_group']) ? $_GET['id_group'] : die();

$part = $partGroup->part_group($id_user, $id_group);

if($part){
// set response code - 200 OK
    http_response_code(200);
    return true;
}  
else{
    // set response code - 503 
    http_response_code(503);
    return false;
}
