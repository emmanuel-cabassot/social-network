<?php
class VideoPost
{

    // database connection and table name
    private $conn;

    // object properties
    public $id_video_post;
    public $name_video_post;
    public $id_post;
    public $id_user; 
    public $chemin;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Enregistre en BDD dans la table video_post la vidéo
     *
     * @return void
     */
    function insertVideoPost()
    {
        $insert = "INSERT INTO video_post (id_post, id_user, name_video_post, chemin) VALUES (:id_post, :id_user, :name_video_post, :chemin)";

        // prepare the query
        $stmt = $this->conn->prepare( $insert );

        // Bind values
        $stmt->bindParam(':id_post', $this->id_post);
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':name_video_post', $this->name_video_post);
        $stmt->bindParam(':chemin', $this->chemin);

        // Execute the query
        $stmt->execute();
    }

    /**
     * Affiche la video d'un post
     *
     * @return object
     */
    function afficheVideoPost()
    {
        $select = "SELECT * FROM video_post WHERE id_post = :id_post";

        // prepare the query
        $stmt = $this->conn->prepare($select);

        // Bind values
        $stmt->bindParam(':id_post', $this->id_post);

        // Execute the query
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}