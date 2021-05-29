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
    public $chemin;
    public $created_at;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Enregistre en BDD dans la table photo_post l'image 
     *
     * @return void
     */
    function insertPhotoPost()
    {
        $insert = "INSERT INTO image_post (id_post, id_user, name_image_post, chemin) VALUES (:id_post, :id_user, :name_image_post, :chemin)";

        // prepare the query
        $stmt = $this->conn->prepare( $insert );

        // Bind values
        $stmt->bindParam(':id_post', $this->id_post);
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':name_image_post', $this->name_image_post);
        $stmt->bindParam(':chemin', $this->chemin);

        // Execute the query
        $stmt->execute();
    }

    /**
     * Affiche les images d'un post
     *
     * @return object
     */
    function affichePhotoPost($id_post)
    {
        $select = "SELECT * FROM image_post WHERE id_post = :id_post ORDER BY id_post DESC";

        // prepare the query
        $stmt = $this->conn->prepare($select);

        // Bind values
        $stmt->bindParam(':id_post', $id_post);

        // Execute the query
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
