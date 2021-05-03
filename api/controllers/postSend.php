<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../models/post.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

$postSend = new PostSend($db);
$postSend->user = 1;
$postSend->title = 'titre';
$postSend->texte = htmlspecialchars(strip_tags($data->texte));

$postSend->sendPost();

if (isset($data->photo)) {
    # code...
}

if (isset($data->video)) {
    # code...
}

json_encode("Ca marche");
  