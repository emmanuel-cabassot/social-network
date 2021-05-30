<?php
session_start();
$folder_name = 'assets/images/upload/temporaire/'.$_SESSION['user']['id'].'/';
// Si des images sont envoyées
if(!empty($_FILES))
{
// Chemin pour enregistrer les images dans dossier temporaire
$folder_name = 'assets/images/upload/temporaire/'.$_SESSION['user']['id'];

if (!is_dir($folder_name)) 
{
mkdir($folder_name);
}
$folder_name = 'assets/images/upload/temporaire/'.$_SESSION['user']['id'].'/';

// tmp_name est le nom temporaire de la photo
 $temp_file = $_FILES['file']['tmp_name'];
 $location = $folder_name . $_FILES['file']['name'];
 // On enregistre la photo dans le dossier voulu
 move_uploaded_file($temp_file, $location);
}

/* Suppression d'une image */
if(isset($_POST["name"]))
{
 $filename = $folder_name.$_POST["name"];
 unlink($filename);
}

/* Supression de toutes les images */
if (isset($_POST["supprime"])) {
    $dir = 'assets/images/upload/temporaire/' .$_SESSION['user']['id'];
    $listePhotos = scandir($dir);
    foreach ($listePhotos as $photo) {
        if ($photo != "." OR $photo != "..") {
            $chemin = 'assets/images/upload/temporaire/' . $_SESSION['user']['id'] . '/' . $photo;
            unlink($chemin);
        }
    }
      
}

$result = array();

$files = scandir('assets/images/upload/temporaire/'.$_SESSION['user']['id']);

$output = '<div class="container-preview">';

if(false !== $files)
{
 foreach($files as $file)
 {
  if('.' !=  $file && '..' != $file)
  {
   $output .= '
   <div class="affichage_preview">
    <img src="'.$folder_name.$file.'" class="img-thumbnail" />
    <button type="button" class="btn btn-link remove_image" id="'.$file.'">&#10006</button>
   </div>
   ';
  }
 }
}
$output .= '</div>';
echo $output;
