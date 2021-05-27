<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate chat object
include_once '../models/chat.php';
  
$database = new Database();
$db = $database->getConnection();


// instantiate chat object
$chat = new Chat($db);
 