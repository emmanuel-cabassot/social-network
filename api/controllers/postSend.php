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

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

$postSend = new post($db);
$postSend->user = $data->user;
$postSend->title = 'titre';
$postSend->texte = $data->texte;

// Créer le post
$postSend->createPost();


if ($data->photo == 'oui') {
    // Retourne l'id du post crée
    $id_post = $postSend->selectPostByText();

    // Création d'un nouveau repertoire upload/post/ + id du post
    mkdir('../../assets/images/upload/post/'.$id_post);

    // On instancie la classe PhotoPost
    $photoPost = new PhotoPost($db);
    $photoPost->id_post = $id_post;
    $photoPost->id_user = $_SESSION['user']['id'];

    // Liste des photos dans le fichier temporaire
    $photos = scandir('../../assets/images/upload/temporaire/' . $_SESSION['user']['id']);

    foreach ($photos as $photo) {
        if ('.' !=  $photo && '..' != $photo) {
            
            $photoPost->name_image_post = $photo;
            $photoPost->chemin = 'assets/images/upload/post/' .$id_post. '/' .$photo; 
            $photoPost->insertPhotoPost();
            $dossierSource = '../../assets/images/upload/temporaire/' . $_SESSION['user']['id']. '/'.$photo;
            $dossierDestination = '../../assets/images/upload/post/' .$id_post. '/' .$photo;
            rename($dossierSource, $dossierDestination);
        }
    }
}   

if (isset($data->video)) {
}

json_encode("Ca marche");
