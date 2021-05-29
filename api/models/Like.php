<?php
class Like
{

    // database connection and table name
    private $conn;

    // object properties
    public $id_like_post;
    public $id_post;
    public $id_user;
    
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function possibleLike($id_post, $id_user) {
        $count = "SELECT COUNT(*) FROM like_post WHERE  id_post = $id_post AND id_user = $id_user";
        $possibleLike = $this->conn->query($count);
        return $possibleLike->fetchColumn();
    }

    public function countLike($id_post) {
        $count = "SELECT COUNT(*) FROM like_post WHERE id_post = $id_post";
        $countLike = $this->conn->query($count);
        return $countLike->fetchColumn();
    }


}