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

if (isset($data->user)) {
    $user = $data->user;

    $postUser = new Post($db);
    $posts = $postUser->listPostUser($user);

    echo json_encode($posts);
}

if (isset($data->id_post)) {
    $id_post = $data->id_post;

    $classPost = new Post($db);
    $post = $classPost->showPostById($id_post);

    if ($post['id_user'] == $_SESSION['user']['id']) {
        $post['myPost'] = 'oui';
    } else {
        $post['myPost'] = 'non';
    }

    if (isset($post['image_post']) and $post['image_post'] == "oui") {
        $classImages = new PhotoPost($db);
        $images = $classImages->affichePhotoPost($id_post);
        $post['images'] = $images;
    }

    if (isset($post['video_post']) and $post['video_post'] == "oui") {
        $classVideo = new VideoPost($db);
        $video = $classVideo->afficheVideoPost($id_post);
        $post['video'] = $video;
    }

    $classComment = new comment($db);
    $countComments = $classComment->CountCommentById($id_post);
    $post['countComment'] = $countComments;
    if ($countComments > 0) {
        $comments = $classComment->showCommentById($id_post);
        $post['comments'] = $comments;
    }

    $classLike = new Like($db);
    $countLike = $classLike->countLike($id_post);
    $post['countLike'] = $countLike;
    $possibleLike = $classLike->possibleLike($id_post, $_SESSION['user']['id']);
    $post['possibleLike'] = $possibleLike;

    $classDislike = new Dislike($db);
    $countDislike = $classDislike->countDislike($id_post);
    $post['countDislike'] = $countDislike;
    $possibleDislike = $classDislike->possibleDislike($id_post, $_SESSION['user']['id']);
    $post['possibleDislike'] = $possibleDislike;


    echo json_encode($post);
}
