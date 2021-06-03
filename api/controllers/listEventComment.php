<?php
session_start();

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
//$id_user= $_SESSION['id_user'];
$id_user=1;

$id_event=isset($_GET['id_event']) ? $_GET['id_event']: die();
$participe = $event->particip_event($id_user, $id_event);

if($participe==true){    
    $stmt = $event->listEventComment($id_event);
    $num = $stmt->rowCount();

    if ($num>0){
  
        $comment_arr=array();
        $comment_arr['records']=array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
        // extract row
        // this will make $row['name'] to
        // just $name only
       
         $comment_item = array(
            "id_comment_event" => $id_comment_event,
            "text_comment" => $text_comment,
            "date_comment" => $date_comment,
            "avatar" => $avatar,
            "name" => $name,
            "lastname" => $lastname
            
        );

        array_push($comment_arr["records"], $comment_item);

    }

      // set response code - 200 OK
    http_response_code(200);

    // show products data
    echo json_encode($comment_arr);
    }

    else{
    // set response code - 404 Not found
    http_response_code(404);
    }
}
