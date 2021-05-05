<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
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

$id_user= $_SESSION['id_user'];

$stmt = $event->listEvents();
$num = $stmt->rowCount();

if ($num>0){
    $event_arr=array();
    $event_arr['records']=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        // extract row
        // this will make $row['name'] to
        // just $name only
        $event_item = array(
           
            "id_event" =>$id_event,
            "id_user_creator" =>$id_user_creator,
            "title_event" =>$title_event,
            "text_event" =>$text_event,
            "date_event" =>$date_event,
            "city_event" =>$city_event,
            "img_event" =>$img_event
   
        );

        array_push($event_arr["records"], $event_item);

    }

      // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($event_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    
}
