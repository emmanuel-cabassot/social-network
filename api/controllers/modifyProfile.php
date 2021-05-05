<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../models/ModifyProfile.php';
  
$database = new Database();
$db = $database->getConnection();


// instantiate user object
$modify = new ModifyProfile($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set user property values
$modify->email = $data->email;
$modify->password = $data->password;
$modify->name = $data->name;
$modify->lastname = $data->lastname;
$modify->avatar = $data->avatar;
$modify->city = $data->city;
$modify->country = $data->country;
$modify->birth = $data->birth;
$modify->creation = $data->creation; 
$modify->role = "user"; 
$modify->blocked = "non"; 
$modify->period_block = "";
$modify->banner = $data->banner;


$id_user = $data->id_user;

//check if user same session user
if($data->id_user==$_SESSION['id_user']){
 
    $modifProfil = $modify->modifProfil($id_user);
    
    if($modifProfil){
    // set response code
    http_response_code(200);

    echo json_encode(
            array(
                "message" => "Modification réalisée.",
            )
        );
    }else{
       
    // set response code
    http_response_code(503);

    } 
}else{http_response_code(406);}

?>