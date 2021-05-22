<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: *");
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
 
// define absolute folder path
$dest_folder = '../../assets/images/upload/events/';

if (!empty($_FILES)) {
	
	// if dest folder doesen't exists, create it
	if(!file_exists($dest_folder) && !is_dir($dest_folder)) mkdir($dest_folder);
	
    $tempFile = $_FILES['file']['tmp_name'];        
    $targetFile =  $dest_folder . $_FILES['file']['name'];
    move_uploaded_file($tempFile,$targetFile);
}

 
// set user property values

    
    $event->id_user_creator = $_SESSION['id_user'];
    $event->title_event = $_POST['title_event'];
    $event->text_event = $_POST['text_event'];
    $event->date_event = $_POST['date_event'];
    $event->city_event = $_POST['city_event'];
    $event->img_event = $_POST['img_event'];
    $event->public_event = $_POST['public_event'];
    $event->signalized = 'non';
    $event->blocked = 'non';
    


//check if session open 
if(isset($_SESSION['id_user'])){
    
    $addEvent = $event->addEvent();
    
    if($addEvent){
        $partEvent =$event->partEvent($_SESSION['id_user'], $addEvent);
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