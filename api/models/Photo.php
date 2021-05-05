<?php
class PostSend{

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
}