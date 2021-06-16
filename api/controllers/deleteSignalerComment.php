<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
if (isset($data->supprimer) AND $data->supprimer == 'oui') {
    $supprime = 'oui';
}

if (isset($data->signaler) AND $data->signaler == 'oui') {
    $signaler = 'oui';
}

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../models/Comment.php';

// Instancie database and product object
$database = new Database();
$db = $database->getConnection();

if (isset($supprime)) {
    $supprimeComment = new Comment($db);
    $supprimeComment->deleteCommentById($data->id_comment);
}

if (isset($signaler)) {
    $signalerComment = new Comment($db);
    $signalerComment->signalizedCommentById($data->id_comment);
}