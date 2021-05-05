<?php
class Contact{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id;
    public $name;
    public $lastname;
    public $avatar;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function listContacts($id_user){

    // select all query
    $query =  'SELECT id_user_friend, users.name, users.lastname, users.avatar, id_connected FROM friend JOIN users ON friend.id_user_friend=users.id_user JOIN connected ON friend.id_user_friend=connected.id_user WHERE  id_user=:id_user';

    // prepare query statement
    $stmt = $this->conn->prepare($query);
   
    // bind
    $stmt->bindParam(':id_user', $id_user);
  
    // execute query
    $stmt->execute();

    return $stmt;

    }

}