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
include_once '../models/Event.php';
  
$database = new Database();
$db = $database->getConnection();


// instantiate user object
$event = new Event($db);
 
// check email existence here
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set user property values

    
    $event -> id_user_creator = $data-> id_user_creator;
    $event -> title_event = $data-> title_event;
    $event -> text_event = $data-> text_event;
    $event -> date_event = $data-> date_event;
    $event -> city_event = $data-> city_event;
    $event -> img_event = $data-> img_event;
    $event -> public_event = $data-> public_event;
    $event -> signalized = '9';
    $event -> blocked = '9';
    


//check if session open 
//if(isset($_SESSION['id_user'])){
    if(1==1){
    $addEvent = $event->addEvent();
    
    if($addEvent){
    // set response code
    http_response_code(200);

    echo json_encode(
            array(
                "message" => "Enregistrement event réalisé.",
            )
        );
    }else{
       
    // set response code
    http_response_code(503);

    } 
}else{http_response_code(406);}

?>