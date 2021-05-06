<?php
// required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  
// include database and object files
include_once '../config/database.php';
include_once '../models/event.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$oneEvent = new Event($db);
  
// set ID property of record to read
$oneEvent->id_event = isset($_GET['id_event']) ? $_GET['id_event'] : die();
  
// read the details of product to be edited
$oneEvent->view_event($oneEvent->id_event);
  
if($oneEvent->id_event != null){
    // create array
    $oneEvent_arr = array(
        "id_event" =>  $oneEvent->id_event,
        "id_user_creator"=> $oneEvent->id_user_creator,
        "title_event"=> $oneEvent->title_event,
        "text_event" => $oneEvent->text_event,
        "date_event" => $oneEvent->date_event,
        "city_event" => $oneEvent->city_event,
        "img_event" =>$oneEvent->img_event,
        "public_event" =>$oneEvent->public_event,
        "signalized" =>$oneEvent->signalized,
        "blocked"=>$oneEvent->blocked 
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($oneEvent_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(401);
  
    $oneEvent_arr["records"]= "Pas de résultat.";
    echo json_encode($oneEvent_arr);

}
?>