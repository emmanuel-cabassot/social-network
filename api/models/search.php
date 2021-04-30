<?php
class Search{

    // database connection and table name
    private $conn;
    
    // object properties
    public $id;
    public $auteur;
    public $notions;
    public $sujet;
    public $serie;
    public $lieu;
    public $image;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
 
// used when filling up the search form
function readOne(){

    // query to read single record
    $query = "SELECT
               *
            FROM
                sujets

            WHERE
                id = ?
            ";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of sujet
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->auteur = $row['auteur'];
    $this->serie = $row['serie'];
    $this->lieu = $row['lieu'];
    $this->notions = $row['notions'];
    $this->sujet = $row['sujet'];
    $this->image = $row['image'];
    
    
}

// search sujets
function search($keyword){

    // select all query
    $query =  'SELECT id_mots, mots FROM mots_clef WHERE mots LIKE CONCAT(:partial, "%") LIMIT 20';

    // prepare query statement
    $stmt = $this->conn->prepare($query);
   
    // bind
    $stmt->bindParam(':partial', $keyword);
  
    // execute query
    $stmt->execute();

    return $stmt;

}

function recherche($keyword){
    $query =  "SELECT * FROM sujets  WHERE sujet like CONCAT('%', :mot,'%') LIMIT 20";

    // prepare query statement
    $stmt = $this->conn->prepare($query);
   
    // bind
    $stmt->bindValue(':mot', $keyword, PDO::PARAM_STR);
  
    // execute query
    $stmt->execute();

    return $stmt; 
}



}
?>
