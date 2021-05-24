<?php
class Search{

    // database connection and table name
    private $conn;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used when filling up the search form
    function searchText($search){

        // query to read single record
        $query = 'SELECT id_user, name, lastname, avatar FROM users WHERE name LIKE CONCAT(:partial, "%") LIMIT 10 ';

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of sujet
        $stmt->bindParam(':partial', $search);

        // execute query
        $stmt->execute();

        return $stmt;
            
    }



}

