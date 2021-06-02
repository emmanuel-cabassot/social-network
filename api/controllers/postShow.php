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
include_once '../models/Post.php';
include_once '../models/PhotoPost.php';
include_once '../models/VideoPost.php';
include_once '../models/Comment.php';
include_once '../models/Like.php';
include_once '../models/Dislike.php';

// Instancie database and product object
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));


$user = $data->user;

$postUser = new Post($db);
$posts = $postUser->idPostUser($user);
$i = 0;
foreach ($posts as $post) {
    
    $id_post = $post['id_post'];  

    $classPost = new Post($db);
    $post = $classPost->showPostById($id_post);
    $user = $classPost->userById($post['id_user']);
    $post['userLastname'] = $user['lastname'];
    $post['userName'] = $user['name'];

    if ($post['id_user'] == $_SESSION['id_user']) {
        $post['myPost'] = 'oui';
    } else {
        $post['myPost'] = 'non';
    }

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

    $classComment = new comment($db);
    $countComments = $classComment->CountCommentById($id_post);
    $post['countComment'] = $countComments;
    if ($countComments > 0) {
        $comments = $classComment->showCommentById($id_post);
        foreach ($comments as $comment) {
             $idComment = $comment['id_comment_post'];
             

        }
        $post['comments'] = $comments;
    }

    $classLike = new Like($db);
    $countLike = $classLike->countLike($id_post);
    $post['countLike'] = $countLike;
    $possibleLike = $classLike->possibleLike($id_post, $_SESSION['id_user']);
    $post['possibleLike'] = $possibleLike;

    $classDislike = new Dislike($db);
    $countDislike = $classDislike->countDislike($id_post);
    $post['countDislike'] = $countDislike;
    $possibleDislike = $classDislike->possibleDislike($id_post, $_SESSION['id_user']);
    $post['possibleDislike'] = $possibleDislike;

    $arrayPost[$i] = $post;
    $i++;
}

echo json_encode($arrayPost);
