<?php

if (isset($_POST)) {
  var_dump($_POST);
}
$target_dir = "assets/images/upload/groups/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$msg = ""; 
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
$msg = "Successfully uploaded"; 
  }else{    
$msg = "Error while uploading"; 
  } 
  echo $msg;
  exit;



if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
    {
        echo "RECEIVED ON SERVER: \n";
        echo "FILES: \n";
        print_r($_FILES);
        echo "\$_POST: \n";
        print_r($_POST);
    }