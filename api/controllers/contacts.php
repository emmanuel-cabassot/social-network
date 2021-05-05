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
include_once '../models/Contact.php';
  
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$contact = new Contact($db);

$id_user= $_SESSION['id_user'];

$stmt = $contact->listContacts($id_user);
$num = $stmt->rowCount();

if ($num>0){
    $contact_arr=array();
    $contact_arr['records']=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        // extract row
        // this will make $row['name'] to
        // just $name only
        $contact_item = array(
            "id_user_friend" => $id_user_friend,
            "name" => $name,
            "lastname" => $lastname,
            "avatar" => $avatar,
            "id_connected" => $id_connected
        );

        array_push($contact_arr["records"], $contact_item)

    }

      // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($search_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    
}



