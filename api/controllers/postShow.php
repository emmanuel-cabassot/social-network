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
include_once '../models/User.php';

// Instancie database and product object
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));


$user = $data->user;

$postUser = new Post($db);

$posts = $postUser->idPostUser($user);
$increment = 0;
foreach ($posts as $post) {
    
    $id_post = $post['id_post'];  

    $classPost = new Post($db);
    $post = $classPost->showPostById($id_post);
    $post['text_post'] = nl2br($post['text_post']);
    $user = $classPost->userById($post['id_user']);
    $post['userLastname'] = ucfirst($user['lastname']);
    $post['userName'] = ucfirst($user['name']);
    $post['userAvatar'] = $user['avatar'];

    if ($post['id_user'] == $_SESSION['id_user']) {
        $post['myPost'] = 'oui';
    } else {
        $post['myPost'] = 'non';
    }

    $classUserSession = new User($db);
    $userSession = $classUserSession->userById($_SESSION['id_user']);
    $post['avatarUserSession'] = $userSession['avatar'];

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
        $classUser = new User($db);
        $comments = $classComment->showCommentById($id_post);
        $i = 0;
        foreach ($comments as $comment) {
             $idUserComment = $comment['id_user'];
             $userComment = $classUser->userById($idUserComment);

             $post['comments'][$i] = $comment;
             $post['comments'][$i]['text_comment_post'] = nl2br($post['comments'][$i]['text_comment_post']);
             $post['comments'][$i]['userName'] = ucfirst($userComment['name']);
             $post['comments'][$i]['userlastName'] = ucfirst($userComment['lastname']);
             $post['comments'][$i]['userAvatar'] = $userComment['avatar'];
             $i++;
        }
        
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

    $arrayPost[$increment] = $post;
    $increment++;
}

echo json_encode($arrayPost);
