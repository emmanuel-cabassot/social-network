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

// Instancie database and product object
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));


// Instancie Modele post 
$postSend = new post($db);

// Hydrate la l'objet
$postSend->image = $data->photo;
$postSend->video = $data->video;
$postSend->story = $data->story;
$postSend->user = $data->user;
$postSend->title = 'titre';
$postSend->texte = strip_tags($data->texte);


// Créer le post
$test = $postSend->createPost();
echo json_encode($test);

// Si des photos sont présentes
if ($data->photo == 'oui') {
    // Retourne l'id du post crée
    $id_post = $postSend->selectPostByText();

    // Création d'un nouveau repertoire upload/post/ + id du post
    mkdir('../../assets/images/upload/post/' . $id_post);

    // On instancie la classe PhotoPost
    $photoPost = new PhotoPost($db);
    $photoPost->id_post = $id_post;
    $photoPost->id_user = $_SESSION['user']['id'];

    // Liste des photos dans le fichier temporaire
    $photos = scandir('../../assets/images/upload/temporaire/' . $_SESSION['user']['id']);

    foreach ($photos as $photo) {
        if ('.' !=  $photo && '..' != $photo) {

            $photoPost->name_image_post = $photo;
            $photoPost->chemin = 'assets/images/upload/post/' . $id_post;
            $photoPost->insertPhotoPost();
            $dossierSource = '../../assets/images/upload/temporaire/' . $_SESSION['user']['id'] . '/' . $photo;
            $dossierDestination = '../../assets/images/upload/post/' . $id_post . '/' . $photo;
            rename($dossierSource, $dossierDestination);
        }
    }
}

if ($data->video == 'oui') {
    // Retourne l'id du post crée
    $id_post = $postSend->selectPostByText();
    
    // Création d'un nouveau repertoire upload/post/ + id du post
    mkdir('../../assets/videos/upload/post/' . $id_post);

    // On instancie la classe VideoPost
    $videoPost = new VideoPost($db);
    $videoPost->id_post = $id_post;
    $videoPost->id_user = $_SESSION['user']['id'];

    // Liste des photos dans le fichier temporaire
    $videos = scandir('../../assets/videos/upload/temporaire/' . $_SESSION['user']['id']);
    
    foreach ($videos as $video) {
        if ('.' !=  $video && '..' != $video) {
            $videoPost->name_video_post = $video;
            $videoPost->chemin = 'assets/videos/upload/post/' . $id_post;
            $videoPost->insertVideoPost();
            $dossierSource = '../../assets/videos/upload/temporaire/' . $_SESSION['user']['id'] . '/' . $video;
            $dossierDestination = '../../assets/videos/upload/post/' . $id_post . '/' . $video;
            rename($dossierSource, $dossierDestination);
        }
    }
}

json_encode("Ca marche");
