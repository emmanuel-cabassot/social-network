<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
$id_post = $data->post;
$id_user = $_SESSION['id_user'];

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../models/Like.php';
include_once '../models/Dislike.php';

// Instancie database and product object
$database = new Database();
$db = $database->getConnection();

// instantiate Like object
$like = new Like($db);
$dislike = new Dislike($db);


if ($data->bdLike == '1') {
    $like->addLike($id_post,$id_user);
}

if ($data->bdLike == '-1') {
    $like->deleteLike($id_post,$id_user);
}

if ($data->bdDislike == '1') {
    $dislike->addDisLike($id_post,$id_user);
}

if ($data->bdDislike == '-1') {
    $dislike->deleteDisLike($id_post,$id_user);
}
