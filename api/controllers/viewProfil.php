<?php

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *"); 

// include database and object files
include_once '../config/database.php';
include_once '../models/Profil.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$profil = new Profil($db);

$id_profil = $_SESSION['id_user'];

$profil->viewProfil($id_profil);

if($profil->name!=null){
    // create array

    $profil_arr = array(
        "email" => $profil->email,
        "name" => $profil->name,
        "lastname" => $profil->lastname,
        "avatar" => $profil->avatar,
        "city" => $profil->city,
        "country" =>$profil->country,
        "birth" =>$profil->birth,
        "blocked"=>$profil->blocked,
        "period_block"=>$profil->period_block
       
    );


    // set response code - 200 OK
    http_response_code(200);

    // show products data
    echo json_encode($profil_arr);
    }

else{
// set response code - 404 Not found
http_response_code(404);

}