<?php
// required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  
// include database and object files
include_once '../config/database.php';
include_once '../models/search.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$search = new Search($db);
  
// set ID property of record to read
$search->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$search->readOne($search->id);
  
if($search->auteur!=null){
    // create array
    $search_arr = array(
        "id" =>  $search->id,
        "serie"=> $search->serie,
        "lieu"=> $search->lieu,
        "auteur" => $search->auteur,
        "notions" => $search->notions,
        "sujet" => $search->sujet,
        "image" =>$search->image 
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($search_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(401);
  
    $search_arr["records"]= "Pas de résultat.";
    echo json_encode($search_arr);

}
?>