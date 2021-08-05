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
include_once '../models/Friend.php';
  
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$friend = new Friend($db);

$id_user = $_SESSION['id_user'];
//$id_user =38;


$list = $friend->listFriends($id_user);
$num = $list->rowCount();

if ($num>0){
    $friend_arr=array();
    $friend_arr['records']=array();

    while ($row = $list->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        // extract row
        // this will make $row['name'] to
        // just $name only

        $friend_item = array(
            "id_user"=>$id_user,
            "id_follow" => $id_follow,
            "id_follower" =>$id_follower,
            "id_followed" =>$id_followed,
            "id_friend" => $id_friend,
            "name" => $name,
            "lastname" => $lastname,
            "avatar" => $avatar,
            "city" => $city,
            "country" => $country,
            "confirmed" => $confirmed,
            "connected" => $id_connected         
        );

        array_push($friend_arr["records"], $friend_item);

    }

      // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($friend_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);  
    
}

