<?php
// required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  
// include database and object files
include_once '../config/database.php';
include_once '../models/group.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$group = new Group($db);
  
// set ID property of record to read
$group->id_group = isset($_GET['id_group']) ? $_GET['id_group'] : die();
  
// read the details of product to be edited
$group->viewGroup($group->id_group);
  
if($group->id_group!=null){
    // create array
    $group_arr = array(
        "id_group" =>  $group->id_group,
        "name_group"=> $group->name_group,
        "description"=> $group->description,
        "img_group" => $group->img_group         
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($group_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(401);
  
    $group_arr["records"]= "Pas de résultat.";
    echo json_encode($group_arr);

}
?>