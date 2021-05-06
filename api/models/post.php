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
    public $video;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function createPost(){

        $default = 'non';
        $date_now = date('Y-m-d H:i:s');
 
        // Créer le post

        $insert = "INSERT INTO post (id_user, title_post, text_post, date_post, public, signalized, blocked, video) VALUES (:user, :title, :texte, :date_post, :public, :signalized, :blocked, :video)";
     
        // prepare the query
        $stmt = $this->conn->prepare( $insert );
     
        // bind user, title, texte
        $stmt->bindParam(':user', $this->user);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':texte', $this->texte);
        $stmt->bindParam(':date_post', $date_now);
        $stmt->bindParam(':public', $default);
        $stmt->bindParam(':signalized', $default);
        $stmt->bindParam(':blocked', $default);
        $stmt->bindParam(':video', $default);

        // execute the query
        $stmt->execute();
    }

    // Sélectionner un poste par rapport a son texte
    
    function selectPostByText()
    {
        $select = "SELECT id_post FROM post WHERE text_post = :text_post";

        // prepare the query
        $stmt = $this->conn->prepare($select);

        // bind id_post
        $stmt->bindParam(':text_post', $this->texte);

        // execute
        $stmt->execute();

        $id = $stmt->fetch(PDO::FETCH_OBJ);

        return $id->id_post;




        
    }

}