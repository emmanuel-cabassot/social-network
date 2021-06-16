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

    public function addComment()
    {
        $select = "INSERT INTO comment_post (id_post, id_user, text_comment_post, date_comment_post) VALUES (:id_post, :id_user, :text_comment_post, :date_comment_post)";

        // Prepare the query
        $stmt = $this->conn->prepare($select);

        // Bind values
        $stmt->bindParam(':id_post', $this->id_post);
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':text_comment_post', $this->text_comment_post);
        $stmt->bindParam(':date_comment_post', $this->date_comment_post);
        
        // Execute the query
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    /**
     * Supprime un comment par rapport à son id
     *
     * @param int $id_comment
     * @return void
     */
    function deleteCommentById($id_comment)
    {
        $delete = "DELETE FROM comment_post WHERE id_comment_post = :id_comment_post";

        // Prepare the query
        $stmt = $this->conn->prepare($delete);

        // Bind
        $stmt->bindParam('id_comment_post', $id_comment);

        // Execute
        $stmt->execute();
    }

    /**
     * Modifie le comment et le met en signalized: 'oui'
     *
     * @param int $id_comment
     * @return void
     */
    function signalizedCommentById($id_comment)
    {
        $signalized = 'oui';
        $update = "UPDATE comment_post SET signalized = :signalized WHERE id_comment_post = :id_comment_post";

        // Prepare the query
        $stmt = $this->conn->prepare($update);

        // Bind
        $stmt->bindParam('signalized', $signalized);
        $stmt->bindParam('id_comment_post', $id_comment);

        // Execute
        $stmt->execute();
    }

}