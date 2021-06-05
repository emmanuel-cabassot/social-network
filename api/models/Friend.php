<?php
class Friend{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id_friend;    
    public $id_from;
    public $id_to; 
    public $confirmed;   
    public $name;
    public $lastname;
    public $email;
    public $avatar;
    public $city;
    public $country;
    public $countFriend;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function listFriends($id_user){

        // select all query
        $query = 'SELECT id_user, name, lastname, avatar, city, country FROM friend LEFT JOIN users ON `id_followed`=users.id_user LEFT JOIN connected ON connected.id_user=`id_followed` WHERE `id_follower`= id_user UNION SELECT id_user, name, lastname, avatar, city, country FROM friend LEFT JOIN users ON `id_follower`=users.id_user LEFT JOIN connected ON connected.id_user=`id_follower` WHERE `id_followed`= :id_user LIMIT 20';
    
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
    $query = 'SELECT id_user FROM friend LEFT JOIN users ON `id_followed`= users.id_user WHERE `id_follower` IN (SELECT `id_followed` FROM friend WHERE `id_follower`= 1) AND `id_followed` not in (select `id_follower` from friend where `id_followed`= 1)
    UNION
    SELECT id_user FROM friend LEFT JOIN users ON `id_follower`= users.id_user WHERE `id_followed` IN (SELECT `id_follower` FROM friend WHERE `id_followed`= 1) AND `id_follower` not in (select `id_followed` from friend where `id_follower`= 1)
     ORDER BY RAND() LIMIT 5';

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

  
        
    function forgetFriend($id_friend){        
        $del= " DELETE FROM friend WHERE id_friend = :id_friend";
        $stmt = $this->conn->prepare($del);

        $stmt->bindParam(':id_friend', $id_friend);            
       
        if($stmt->execute()){
            return true;
        }               
            return false;            
    }

    function countFriend($id_user){
        $counter= "SELECT COUNT(id_friend) AS countAmis FROM friend WHERE id_user=: id_user OR id_user_friend=: id_user";
        $stmt = $this->conn->prepare($counter);
        $stmt->bindParam('id_user', $id_user);
        $stmt->execute();
        $row= $stmt->fetch();
        $this->countFriend = $row['countAmis'];

    }

}