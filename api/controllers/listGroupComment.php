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
include_once '../models/Group.php';

$database = new Database();
$db = $database->getConnection();

// instantiate user object
$group = new Group($db);
//$id_user=$_SESSION['id_user'];
$id_user=1;

$id_group = isset($_GET['id_group']) ? $_GET['id_group'] : die();
$belong= $group->belong_group($id_user, $id_group);

if($belong==true){
   $stmt = $group->listGroupComment($id_group);
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
                "id_comment_group" => $id_comment_group,
                "text_comment" => $text_comment,
                "date_comment" => $date_comment,
                "avatar" => $avatar,
                "name" => $name,
                "lastname" => $lastname,
                "belong" => $belong               
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
}else{
    http_response_code(501);
}


