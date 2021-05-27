<?php
class Friend{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id_friend;    
    public $id_user;
    public $id_user_friend; 
    public $confirmed;   
    public $name;
    public $lastname;
    public $email;
    public $avatar;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function listFriends($id_user){

    // select all query
    $query = 'SELECT id_friend, id_user_friend FROM friend  WHERE id_user=:id_user LIMIT 20';

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $id_user=htmlspecialchars($id_user);

    $stmt->bindParam(":id_user", $id_user);    
    // execute query
    $stmt->execute();

    return $stmt;

    }

    function viewFriend($id_user){
        $view= "SELECT * FROM users WHERE id_user=:id_user";

        // prepare query statement
        $stmt = $this->conn->prepare($view);

        $stmt->bindParam(':id_user', $id_user);

       // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->id_user = $row['id_user'];
        $this->name = $row['name'];
        $this->lastname = $row['lastname'];
        $this->avatar = $row['avatar'];
        $this->city = $row['city'];
        $this->country = $row['country'];

    }



    function suggestFriends($id_user){

    // select all query
    $query = 'SELECT * FROM friend LEFT JOIN  users ON friend.id_user_friend= users.id_user WHERE  friend.id_user IN (SELECT id_user_friend  FROM friend WHERE friend.id_user= :id_user) ORDER BY RAND() LIMIT 5';

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $id_user=htmlspecialchars($id_user);

    $stmt->bindParam(":id_user", $id_user);    
    // execute query
    $stmt->execute();

    return $stmt;

    }

    function invitFriend($id_user, $id_user_friend){
        // query to insert record
        $query = "INSERT INTO friend SET id_user=:id_user, id_user_friend=:id_user_friend, confirmed= 'non'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
       
        $id_user=htmlspecialchars($id_user);
        $id_user_friend=htmlspecialchars($id_user_friend);
                        
        // bind values
      
        $stmt->bindParam(":id_user", $id_user);
        $stmt->bindParam(":id_user_friend", $id_user_friend);
                
        // execute query
        if($stmt->execute()){
            return true;
        }
            return false;    
    }

    function confirmFriend($id_friend){
        // query to update record
        $query = "UPDATE friend SET confirmed='oui' WHERE id_friend=:id_friend";
            
        // prepare query
        $stmt = $this->conn->prepare($query);
        $id_friend=htmlspecialchars($id_friend);
                        
        // bind values
      
        $stmt->bindParam(":id_friend", $id_friend);

        if($stmt->execute()){
            return true;
        }
            return false; 

    }

  
        
    function delete_friend($id_friend){        
        $del= " DELETE FROM friend WHERE id_friend = :id_friend";
        $stmt = $this->conn->prepare($del);

        $stmt->bindParam(':id_friend', $id_friend);            
       
        if($stmt->execute()){
            return true;
        }               
            return false;            
    }

}