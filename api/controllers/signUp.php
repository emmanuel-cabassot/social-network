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
include_once '../models/SignUp.php';
  
$database = new Database();
$db = $database->getConnection();


// instantiate user object
$signup = new SignUp($db);
 
// check email existence here
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set user property values
$signup->email = $data->email;
$signup->password = $data->password;
$signup->name = $data->name;
$signup->lastname = $data->lastname;
$signup->avatar = $data->avatar;
$signup->city = $data->city;
$signup->country = $data->country;
$signup->birth = $data->birth;
$signup->creation = $data->creation; 
$signup->role = "user"; 
$signup->blocked = "non"; 
$signup->period_block = "0001-01-01";
$signup->banner = $data->banner;


$email_exists = $signup->emailExists();

//check if email exists 
if($email_exists){
 
    $create_user = $signup->create_user();
    
    if($create_user){
    // set response code
    http_response_code(200);

    echo json_encode(
            array(
                "message" => "Inscription réalisée.",
            )
        );
    }else{
       
    // set response code
    http_response_code(503);

    } 
}else{http_response_code(406);}

?>