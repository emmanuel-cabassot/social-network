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
    public $public;
    public $signalized;
    public $blocked;
    public $image;
    public $video;
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
        $non = 'non';

        // Requête
        $insert = "INSERT INTO post (id_user, title_post, text_post, date_post, public, signalized, blocked, video_post, image_post, story_post) VALUES (:user, :title, :texte, :date_post, :public, :signalized, :blocked, :video_post, :image_post, :story_post)";
     
        // prepare the query
        $stmt = $this->conn->prepare( $insert );
     
        // bind user, title, texte.....
        $stmt->bindParam(':user', $this->user);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':texte', $this->texte);
        $stmt->bindParam(':date_post', $date_now);
        $stmt->bindParam(':public', $non);
        $stmt->bindParam(':signalized', $non);
        $stmt->bindParam(':blocked', $non);
        $stmt->bindParam(':video_post', $this->video);
        $stmt->bindParam(':image_post', $this->image);
        $stmt->bindParam(':story_post', $this->story);

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
    function listPostUser($user)
    {
        $select = "SELECT id_post FROM post WHERE id_user = :id_user ORDER BY id_post DESC";

        // prepare the query
        $stmt = $this->conn->prepare($select);

        // bind 
        $stmt->bindParam(':id_user', $user);

        // execute
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  

    function showPostById($id_post)    
    {
        $select = "SELECT * FROM post WHERE id_post = :id_post";

        // Prepare the query
        $stmt = $this->conn->prepare($select);

        // Bind
        $stmt->bindParam(':id_post', $id_post);

        // Execute
        $stmt->execute();

        return $stmt->fetch(PDO:: FETCH_ASSOC);
    }
}