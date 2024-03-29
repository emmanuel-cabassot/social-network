<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
// include database and object files
//include_once '../config/core.php';
include_once '../config/database.php';
include_once '../models/search.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
$array = array();

// initialize object
$search = new Search($db);
  
$searchText = isset($_GET['searchText']) ? $_GET['searchText'] : die();

$stmt = $search->searchText($searchText);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $search_arr=array();
    $search_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $search_item=array(
            "id_user" => $id_user,
            "name" => $name,
            "lastname" => $lastname,
            "avatar" => $avatar   
        );
  
        array_push($search_arr["records"], $search_item);
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


