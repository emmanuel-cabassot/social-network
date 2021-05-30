<?php

session_start();
// required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  
// include database and object files
include_once '../config/database.php';
include_once '../models/group.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$groupe = new Group($db);
  
// set ID property of record to read
$id_group = isset($_GET['id_group']) ? $_GET['id_group'] : die();
  
// read the details of product to be edited
$groupe->viewGroup($id_group);
  
if($groupe->name_group!=null){
    // create array
    $id_user= $_SESSION['id_user'];
    $groupe->count_belong($id_group);
    $belong= $groupe->belong_group($id_user, $id_group);

    $group_arr = array(
        "id_group" => $groupe->id_group,
        "name_group" => $groupe->name_group,
        "description" => $groupe->description,
        "img_group" => $groupe->img_group,
        "id_user_create" => $groupe->id_user_create,
        "count" => $groupe->count_belong,
        "belong" => $belong      
    );

    if($belong==true){
       
        $stmt = $groupe->listGroupComment($id_group);
        $num = $stmt->rowCount();

        if ($num>0){
        
            $group_arr['comments']=array();

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
                    "lastname" => $lastname
                    
                );

                array_push($group_arr["comments"], $comment_item);

            }
        }else{
            // set response code - 404 Not found
            $group_arr["comments"]= "Pas de commentaire.";

        }
    }else{ $group_arr["comments"]="Vous devez participer à ce groupe, pour voir les commentaires.";}
    
        // set response code - 200 OK
        http_response_code(200);
    
        // make it json format
        echo json_encode($group_arr);
    }else{
        // set response code - 401 Not found
        http_response_code(401);
    
        $group_arr["records"]= "Pas de résultat.";
        echo json_encode($group_arr);

    }
    ?>