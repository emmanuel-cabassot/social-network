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


$listFriend = $friend->listFriends($id_user);

$num = $listFriend->rowCount();
$suggest_arr=array();
$suggest_arr['records']=array();
if ($num>0){
   
    while($row = $listFriend->fetch(PDO::FETCH_ASSOC)){
        extract($row);
       $FoF= $friend->listFof($id_user, $id_friend);
       $count=$FoF->rowCount();
        if($count>0){
            while($fow = $FoF->fetch(PDO::FETCH_ASSOC)){
                
                extract($fow);
                // extract row
                // this will make $row['name'] to
                // just $name only
            
                $suggest_item = array(
                    "id_friend" => $id_fof,
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
        }else{
        // set response code - 204 
        http_response_code(404);  
        }
    
    }

}else{
        http_response_code(404);   
    }
