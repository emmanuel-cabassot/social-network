<?php
class Chat{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id;
    public $message;
    public $date;
    public $from_user;
    public $to_user;
    public $status;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function lastChat($id_user){
        // query to insert record
        $query = "SELECT * FROM chat LEFT JOIN users ON to_user=:id_user WHERE message.id IN (SELECT MAX(chat.id) FROM chat GROUP BY chat.to_user, chat.from_user) AND chat.to_user != :id_user AND from_user =: id_user";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values

        $stmt->bindParam(":id_user", $this->id_user);

        // execute query
        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }

        return false;

    }