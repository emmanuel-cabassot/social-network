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
  
// instantiate product object
include_once '../models/Comment.php';
include_once '../models/User.php';
  
$database = new Database();
$db = $database->getConnection();


// instantiate comment object
$comment = new Comment($db);


$data = json_decode(file_get_contents("php://input"));

// set comment property values

$comment->id_post = $data->id_post;
$comment->id_user = $_SESSION['id_user'];
$comment->text_comment_post = $data->text_comment;
$comment->date_comment_post = date('Y-m-d H:i:s');

// Add comment
$comment->addComment();

$classUser = new User($db);
$user = $classUser->userById($_SESSION['id_user']);
$user['date_comment'] = date('Y-m-d H:i:s');
$user['text'] = nl2br($data->text_comment);

echo json_encode($user);




    