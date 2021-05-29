<?php
class Comment
{

    // database connection and table name
    private $conn;

    // object properties
    public $id_comment_post;
    public $id_post;
    public $id_user;
    public $text_comment_post;
    public $blocked;
    public $signalized;
    public $date_comment_post;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function CountCommentById($id_post) {
        $count = "SELECT COUNT(*) FROM comment_post WHERE id_post = $id_post";
        $countComment = $this->conn->query($count);
        return $countComment->fetchColumn();
    }

    public function showCommentById($id_post) {
        $select = "SELECT * FROM comment_post WHERE id_post = :id_post";

        // Prepare the query
        $stmt = $this->conn->prepare($select);

        // Bind values
        $stmt->bindParam(':id_post', $id_post);

        // Execute the query
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}