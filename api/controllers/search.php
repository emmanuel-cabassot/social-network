<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
//include_once '../config/core.php';
include_once '../config/database.php';
include_once '../models/search.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
$array = array();

// initialize object
$search = new Search($db);
  
// get keywords
$q = str_replace("''","'",urldecode($_REQUEST['name']));
$q = strtolower(str_replace("'","''",$q));

  
// query sujets
$stmt = $search->search($q);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
    while($q = $stmt->fetch()){
        $mot = $q->mots;
        $array[] = array(
                'id' => $q->id_mots,
                'label' => $mot,
                'value' => $mot
        );
    }
    $stmt->closeCursor();

   
  
}else{
/* génération réponse JSON */
$array[] = array(
    'id' =>'9999',
    'label'=>'Pas de résultat',
    'value'=>'Pas de résultat'
);


}
http_response_code(200);
header('Content-Type: application/json');
echo json_encode($array);

 
	
?>