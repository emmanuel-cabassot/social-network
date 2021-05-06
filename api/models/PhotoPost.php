<?php
class PhotoPost
{

    // database connection and table name
    private $conn;

    // object properties
    public $id_image_post;
    public $id_post;
    public $id_user;
    public $name_image_post;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function insertPhotoPost()
    {
        $insert = "INSERT INTO image_post (id_post, id_user, name_image_post) VALUES (:id_post, :id_user, :name_image_post)";

        // prepare the query
        $stmt = $this->conn->prepare( $insert );

        // Bind values
        $stmt->bindParam(':id_post', $this->id_post);
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':name_image_post', $this->name_image_post);

        // Execute the query
        $stmt->execute();
    }
}
