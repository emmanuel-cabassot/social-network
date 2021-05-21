<?php
class Post{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id;
    public $user;
    public $title;
    public $texte;
    public $date;
    public $public = 'non';
    public $signalized = 'non';
    public $blocked = 'non';
    public $image = 'non';
    public $video = 'non';
    public $story;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    /**
     * Création d'un post
     *
     * @return void
     */
    function createPost(){
        $date_now = date('Y-m-d H:i:s');

        // Requête
        $insert = "INSERT INTO post (id_user, title_post, text_post, date_post, public, signalized, blocked, video_post, image_post) VALUES (:user, :title, :texte, :date_post, :public, :signalized, :blocked, :video_post, :image_post)";
     
        // prepare the query
        $stmt = $this->conn->prepare( $insert );
     
        // bind user, title, texte.....
        $stmt->bindParam(':user', $this->user);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':texte', $this->texte);
        $stmt->bindParam(':date_post', $date_now);
        $stmt->bindParam(':public', $this->public);
        $stmt->bindParam(':signalized', $this->signalized);
        $stmt->bindParam(':blocked', $this->blocked);
        $stmt->bindParam(':video_post', $this->video);
        $stmt->bindParam(':image_post', $this->image);

        // execute the query
        $stmt->execute();
    }


    /**
     * Recherche un post par rapport à son texte
     *
     * @return int
     */
    function selectPostByText()
    {
        $select = "SELECT id_post FROM post WHERE text_post = :text_post ORDER BY id_post DESC";

        // prepare the query
        $stmt = $this->conn->prepare($select);

        // bind 
        $stmt->bindParam(':text_post', $this->texte);

        // execute
        $stmt->execute();

        $id = $stmt->fetch(PDO::FETCH_OBJ);

        return $id->id_post;        
    }

    /**
     * Affiche les postes d'un utilisateur
     *
     * @return array
     */
    function displayPostUser()
    {
        $select = "SELECT * FROM post WHERE id_user = :id_user";

        // prepare the query
        $stmt = $this->conn->prepare($select);

        // bind 
        $stmt->bindParam(':id_user', $this->user);

        // execute
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }  
}