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
include_once '../models/Post.php';
include_once '../models/User.php';
include_once '../models/VideoPost.php';
include_once '../models/PhotoPost.php';
include_once '../../functions/depuis.php';

$database = new Database();
$db = $database->getConnection();

// instantiate user object
$admPost = new Post($db);

$posts = $admPost->listPostsSignalized();

$increment = 0;
foreach ($posts as $post) {
    
    $id_post = $post['id_post']; 

    $classPost = new Post($db);
    $post = $classPost->showPostById($id_post);
    $post['date_post'] = depuis($post['date_post']);
    $post['text_post'] = nl2br($post['text_post']);
    

    $user = $classPost->userById($post['id_user']);
    $post['userLastname'] = ucfirst($user['lastname']);
    $post['userName'] = ucfirst($user['name']);
    $post['userAvatar'] = $user['avatar'];
    $post['blocked'] = $user['blocked'];
    $post['period_block'] = $user['period_block'];
    

    if ($post['image_post'] == "oui") {
        $classImages = new PhotoPost($db);
        $images = $classImages->affichePhotoPost($id_post);
        $post['images'] = $images;
    }else{
        $post['image_post'] = 'non';
    }

    if (isset($post['video_post']) and $post['video_post'] == "oui") {
        $classVideo = new VideoPost($db);
        $video = $classVideo->afficheVideoPost($id_post);
        $post['cheminVideo'] = $video['chemin'];
        $post['nomVideo'] = $video['name_video_post'];

    }

    $arrayPost[$increment] = $post;
    $increment++;
}

echo json_encode($arrayPost);