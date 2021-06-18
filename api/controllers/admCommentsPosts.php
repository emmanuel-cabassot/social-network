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
include_once '../models/Comment.php';
include_once '../models/User.php';

$database = new Database();
$db = $database->getConnection();

// instantiate user object
$admComment = new Comment($db);

$comments = $admComment->listCommentsSignalized();
$increment = 0;
foreach ($comments as $comment) {
    

    $users = new User($db);
    $user = $users->userById($comment['id_user']);
    $comment['blocked'] = $user['blocked'];
    $comment['period_block'] = $user['period_block'];
    $comment['userLastname'] = $user['lastname'];
    $comment['userName'] = $user['name'];
    $comment['userAvatar'] = $user['avatar'];

    $array[$increment] = $comment;
    $increment++;
    
}

echo json_encode($array);
