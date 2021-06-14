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

// instantiate friend object
include_once '../models/Friend.php';

$database = new Database();
$db = $database->getConnection();


// instantiate friend object
$friend = new Friend($db);

// set ID property of record to
$id_follower = $_SESSION['id_user'];
$id_followed = isset($_GET['id_friend']) ? $_GET['id_friend'] : die();

$invit = $friend->invitFriend($id_follower, $id_followed);

if($invit){
    http_response_code(200);
}
else{
    http_response_code(503);
}
