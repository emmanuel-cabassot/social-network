<?php

session_start();
// required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");

  
// include database and object files
include_once '../config/database.php';
include_once '../models/Group.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$groupe = new Group($db);
  
// set ID property of record to read
$id_group = isset($_GET['id_group']) ? $_GET['id_group'] : die();
  
// read the details of product to be edited
$groupe->viewGroup($id_group);
  
if($groupe->name_group!=null){
    // create array
    $id_user_create= $groupe->id_user_create;
    $create =$groupe->viewCreate($id_user_create);
    $creator = $create->fetch(PDO::FETCH_ASSOC);

    $id_user= $_SESSION['id_user'];
    //$id_user=1;
    $groupe->count_belong($id_group);
    $belong= $groupe->belong_group($id_user, $id_group);

    $group_arr = array(
        "id_group" => $groupe->id_group,
        "name_group" => $groupe->name_group,
        "description" => $groupe->description,
        "img_group" => $groupe->img_group,
        "id_user_create" => $groupe->id_user_create,
        "name_create" =>$creator['name_create'],
        "lastname_create" =>$creator['lastname_create'],
        "avatar_create" =>$creator['avatar_create'],
        "count" => $groupe->count_belong,
        "belong" => $belong      
    );


    // set response code - 200 OK
    http_response_code(200);

    // show products data
    echo json_encode($group_arr);
    }

else{
// set response code - 404 Not found
http_response_code(404);

}