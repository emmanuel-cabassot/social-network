<?php
class PhotoPost
{

    // database connection and table name
    private $conn;


    // object properties
    public $id_images_posts;
    public $id_post;
    public $id_user;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function photoPost()
    {

    }

    function insertPhotoPost()
    {
        
    }
}
