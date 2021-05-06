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

if(isset($_POST["name"]))
{
 $filename = $folder_name.$_POST["name"];
 unlink($filename);
}

$result = array();

$files = scandir('assets/images/upload/temporaire/'.$_SESSION['user']['id']);

$output = '<div class="row">';

if(false !== $files)
{
 foreach($files as $file)
 {
  if('.' !=  $file && '..' != $file)
  {
   $output .= '
   <div class="col-md-2">
    <img src="'.$folder_name.$file.'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
    <button type="button" class="btn btn-link remove_image" id="'.$file.'">Supprimer</button>
   </div>
   ';
  }
 }
}
$output .= '</div>';
echo $output;