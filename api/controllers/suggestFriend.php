<?php
session_start();

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate suggest object
include_once '../models/Friend.php';


// instantiate database and suggest object
$database = new Database();
$db = $database->getConnection();

// instantiate suggest object
$friend = new Friend($db);

$id_user = $_SESSION['id_user'];

//$id_user=1;

$suggest = $friend->suggestFriends($id_user);

$num = $suggest->rowCount();

if ($num>0){
    $suggest_arr=array();
    $suggest_arr['records']=array();

    while ($row = $suggest->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        // extract row
        // this will make $row['name'] to
        // just $name only
       
        $suggest_item = array(
            "id_friend" => $id_friend,
            "name" =>$name,
            "lastname" =>$lastname,
            "avatar" =>$avatar,
            "city"=>$city,
            "country"=>$country,          
        );

        array_push($suggest_arr["records"], $suggest_item);

    }

      // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($suggest_arr);
}
  
else{
    // set response code - 204 
    http_response_code(404);  
    
}
