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
include_once '../models/Profil.php';

$database = new Database();
$db = $database->getConnection();


// instantiate user object
$modify = new Profil($db);


// define absolute folder path
$dest_folder = '../../assets/images/upload/users/';

if (!empty($_FILES)) {

	// if dest folder doesen't exists, create it
	if(!file_exists($dest_folder) && !is_dir($dest_folder)) mkdir($dest_folder);

    $tempFile = $_FILES['file']['tmp_name'];
    $targetFile =  $dest_folder . $_FILES['file']['name'];
    move_uploaded_file($tempFile,$targetFile);
}

// set user property values

    $modify->email = $_POST['email'];
    $modify->password = $_POST['password'];
    $modify->name = $_POST['name'];
    $modify->lastname = $_POST['lastname'];
    $modify->avatar = $_POST['avatar'];
    $modify->city = $_POST['city'];
    $modify->country = $_POST['country'];
    $modify->birth = $_POST['birth'];



if(!empty($_SESSION['id_user'])){

   $id_user= $_SESSION['id_user'];

//check if session open

    $modifyProfil = $modify->modifyProfil($id_user);

    if($modifyProfil){

    // set response code
    http_response_code(200);

    echo json_encode(
            array(
                "message" => "Profil Modifié.",
            )
        );
    }else{

    // set response code
    http_response_code(503);

    }
}else{http_response_code(406);}

?>
