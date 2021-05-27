<?php

session_start();

// required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  
// include database and object files
include_once '../config/database.php';
include_once '../models/friend.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$viewFriend = new Friend($db);
  
// set ID property of record to read
$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die();
  
// read the details of product to be edited
$viewFriend->viewFriend($id_user);
  
if($viewFriend->id_user != null){

        // create array
    $viewFriend_arr = array(
        "id_user" =>  $viewFriend->id_user,
        "name"=> $viewFriend->name,
        "lastname"=> $viewFriend->lastname,
        "avatar" => $viewFriend->avatar,
        "city" => $viewFriend->city,
        "country" => $viewFriend->country         
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($viewFriend_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(401);
  
    $viewFriend_arr["records"]= "Pas de résultat.";
    echo json_encode($viewFriend_arr);

}
?>