<?php
class User{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id_user;
    public $email;
    public $password;
    public $name;
    public $lastname;
    public $avatar;
    public $city;
    public $country;
    public $bird;
    public $creation;
    public $role;
    public $blocked;
    public $period_block;
    public $banner;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function userById($id_user)
    {
        $select = "SELECT * FROM users WHERE id_user = :id_user";

        // Prepare the query
        $stmt = $this->conn->prepare($select);

        // Bind
        $stmt->bindParam('id_user', $id_user);

        // Execute
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function listUsers()
    {
        $select = "SELECT * FROM users";

        // Prepare the query
        $stmt = $this->conn->prepare($select);

        // Execute
        $stmt->execute();

        return $stmt;
    }

    function updateUserBlocked($id_user)
    {
        $update = "UPDATE users SET role = :role, blocked = :blocked, period_block = :period_block WHERE id_user = :id_user";

        // Prepare the query
        $stmt = $this->conn->prepare($update);

        // Bind
        $stmt->bindParam('role', $this->role);
        $stmt->bindParam('blocked', $this->blocked);
        $stmt->bindParam('period_block', $this->period_block);
        $stmt->bindParam('id_user', $id_user);

        // Execute
        $stmt->execute();
    }

    function updateUserBlockedPost($id_user)
    {
        $update = "UPDATE users SET blocked = :blocked, period_block = :period_block WHERE id_user = :id_user";

        // Prepare the query
        $stmt = $this->conn->prepare($update);

        // Bind
        
        $stmt->bindParam('blocked', $this->blocked);
        $stmt->bindParam('period_block', $this->period_block);
        $stmt->bindParam('id_user', $id_user);

        // Execute
        $stmt->execute();
    }
}