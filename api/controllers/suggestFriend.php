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
include_once '../models/Friend.php';
  
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$friend = new Friend($db);

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die();

$stmt = $friend->listFriends($id_user);
$num = $stmt->rowCount();

if ($num>0){
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        // extract row
        // this will make $row['name'] to
        // just $name only
    
            $list = $friend->listFriends($id_user_friend);
            $num=$list->rowCount();
            if ($num>0){
                $suggested_arr=array();
                $suggested_arr['records']=array();
                while ($row= $list->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    // extract row
                    // this will make $row['name'] to
                    // just $name only
                    $friend_item = array(
                        "id_friend" => $id_friend,
                        "id_user" => $id_user,
                        "id_user_friend" => $id_user_friend            
                    );
                    array_push($suggested_arr['records'], $friend_item);  
                }
            }
        }

    

      // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($otherFriend_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);  
    
}

