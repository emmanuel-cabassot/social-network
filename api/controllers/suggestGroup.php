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
include_once '../models/Group.php';


// instantiate database and suggest object
$database = new Database();
$db = $database->getConnection();

// instantiate suggest object
$group = new Group($db);

$id_user = $_SESSION['id_user'];

//$id_user=1;
$stmt = $group->suggestGroup($id_user);
$num = $stmt->rowCount();

if ($num>0){
  
    $group_arr=array();
    $group_arr['records']=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        // extract row
        // this will make $row['name'] to
        // just $name only        
               
                $belong= $group->belong_group($id_user, $id_group);
                $group_item = array(
                    "id_group" => $id_group,
                    "name_group" => $name_group,                   
                    "img_group" => $img_group,                                     
                    "belong" => $belong
                );
        
                array_push($group_arr["records"], $group_item);        
            }
        
              // set response code - 200 OK
            http_response_code(200);
        
            // show products data
            echo json_encode($group_arr);
        }
        
        else{
            // set response code - 404 Not found
            http_response_code(404);        
        }
        