<?php
class Dislike
{

    // database connection and table name
    private $conn;

    // object properties
    public $id_dislike_post;
    public $id_post;
    public $id_user;
    
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function possibleDislike($id_post, $id_user) {
        $count = "SELECT COUNT(*) FROM dislike_post WHERE  id_post = $id_post AND id_user = $id_user";
        $possibleDislike = $this->conn->query($count);
        return $possibleDislike->fetchColumn();
    }

    public function countDislike($id_post) {
        $count = "SELECT COUNT(*) FROM dislike_post WHERE id_post = $id_post";
        $countDislike = $this->conn->query($count);
        return $countDislike->fetchColumn();
    }

    public function addDislike($id_post, $id_user)
    {
        $insert = "INSERT INTO dislike_post (id_post, id_user) VALUES (:id_post, :id_user)";

        // prepare the query
        $stmt = $this->conn->prepare($insert);
     
        // bind post, user
        $stmt->bindParam(':id_post', $id_post);
        $stmt->bindParam(':id_user', $id_user);

        // execute the query
        $stmt->execute();
    }

    public function deleteDislike($id_post, $id_user)
    {
        $delete = "DELETE FROM dislike_post WHERE id_post = :id_post AND id_user = :id_user";

        // prepare the query
        $stmt = $this->conn->prepare($delete);
     
        // bind post, user
        $stmt->bindParam(':id_post', $id_post);
        $stmt->bindParam(':id_user', $id_user);

        // execute the query
        $stmt->execute();
    }
}