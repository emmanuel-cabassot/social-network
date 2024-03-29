<?php
session_start();
$folder_name = 'assets/videos/upload/temporaire/'.$_SESSION['id_user'].'/';
// Si une video est envoyé
if(!empty($_FILES))
{
// Chemin pour enregistrer la video dans dossier temporaire
$folder_name = 'assets/videos/upload/temporaire/'.$_SESSION['id_user'];

if (!is_dir($folder_name)) 
{
mkdir($folder_name);
}
$folder_name = 'assets/videos/upload/temporaire/'.$_SESSION['id_user'].'/';

// tmp_name est le nom temporaire de la video
 $temp_file = $_FILES['file']['tmp_name'];
 $location = $folder_name . $_FILES['file']['name'];
 // On enregistre la video dans le dossier voulu
 move_uploaded_file($temp_file, $location);
}

if(isset($_POST["name"]))
{
 $filename = $folder_name.$_POST["name"];
 unlink($filename);
}

/* Supression de la video */
if (isset($_POST["supprime"])) {
    $dir = 'assets/videos/upload/temporaire/' .$_SESSION['id_user'];
    $listeVideo = scandir($dir);
    foreach ($listeVideo as $video) {
        if ($video != "." OR $video != "..") {
            $chemin = 'assets/videos/upload/temporaire/' . $_SESSION['id_user'] . '/' . $video;
            unlink($chemin);
        }
    }
      
}

$result = array();

$files = scandir('assets/videos/upload/temporaire/'.$_SESSION['id_user']);

$output = '<div class="container-preview">';
$targetImg = substr($folder_name, 3);
if(false !== $files)
{
 foreach($files as $file)
 {
  if('.' !=  $file && '..' != $file)
  {
   $output .= '
   <div">
    <video src="'. $targetImg . $file .'" type="video/mp4" class="img-thumbnail" controls/>
   </div>
   <button type="button" class="btn btn-link remove_video" id="'.$file.'">Supprimer</button>
   ';
  }
 }
}
$output .= '</div>';
echo $output;
