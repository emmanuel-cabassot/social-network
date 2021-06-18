<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../models/User.php';
include_once '../models/Post.php';

// Instancie database and product object
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

$user = new User($db);

$user->blocked = $data->blocked;
$user->period_block = $data->date;

$user->updateUserBlockedPost($data->user);

$post = new Post($db);

if ($data->supprime == 'oui') {
    $post->deletePostById($data->post);
}

if ($data->deleteSignal == 'oui') {
    $post->deleteSignalPostById($data->post);
}
