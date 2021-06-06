<?php
class Friend{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id_friend;    
    public $id_follower;
    public $id_followed; 
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
        $query = 'SELECT id_follow, id_follower, id_followed, users.id_user as id_friend, name, lastname, avatar, city, country, confirmed, id_connected FROM friend LEFT JOIN users ON `id_followed`=users.id_user LEFT JOIN connected ON connected.id_user=`id_followed` WHERE `id_follower`= :id_user UNION SELECT id_follow,id_follower, id_followed, users.id_user as id_friend, name, lastname, avatar, city, country, confirmed, id_connected FROM friend LEFT JOIN users ON `id_follower`=users.id_user LEFT JOIN connected ON connected.id_user=`id_follower` WHERE `id_followed`=:id_user';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        $id_user=htmlspecialchars($id_user);
    
        $stmt->bindParam(":id_user", $id_user);    
        // execute query
        $stmt->execute();
    
        return $stmt;
    
        }

    function viewFriend($id_user){
        $view= "SELECT users.id_user, name, lastname, avatar, city, country FROM users WHERE id_user=:id_user";

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
    $query = 'Select id_user as id_friend, name, lastname, avatar, city, country from users LEFT JOIN friend ON id_user= id_follower where id_followed IN(SELECT users.id_user from users INNER JOIN (select id_follower as ami from friend where id_follower=:id_user union all SELECT id_followed as ami from friend where id_follower=:id_user) as f on users.id_user= f.ami) and id_follower <>:id_user and id_follower not in (select id_followed from friend where id_follower= :id_user) union Select id_user as id_friend, name, lastname, avatar, city, country from users LEFT JOIN friend ON id_user= id_followed where id_follower in (SELECT users.id_user from users INNER JOIN (select id_follower as ami from friend where id_followed=:id_user union all SELECT id_followed as ami from friend where id_follower=:id_user) as f on users.id_user= f.ami) and id_followed <>:id_user and id_followed not in (select id_followed from friend where id_follower= :id_user) ';
    $stmt = $this->conn->prepare($query);

    $id_user=htmlspecialchars($id_user);

    $stmt->bindParam(":id_user", $id_user);    
    // execute query
    $stmt->execute();

    return $stmt;

    }

    function invitFriend($id_follower, $id_followed){
        // query to insert record
        $query = "INSERT INTO friend SET id_follower=:id_follower, id_followed=:id_followed, confirmed= 'non'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
                        
        // bind values
      
        $stmt->bindParam(":id_follower", $id_follower);
        $stmt->bindParam(":id_followed", $id_followed);
        
                
        // execute query
        if($stmt->execute()){
            return true;
        }
            return false;    
    }

    function confirmFriend($id_follow){
        // query to update record
        $query = "UPDATE friend SET confirmed='oui' WHERE id_follow=:id_follow";
            
        // prepare query
        $stmt = $this->conn->prepare($query);
        $id_follow=htmlspecialchars($id_follow);
                        
        // bind values
      
        $stmt->bindParam(":id_follow", $id_follow);

        if($stmt->execute()){
            return true;
        }
            return false; 

    }

  
        
    function forgetFriend($id_follow){        
        $del= " DELETE FROM friend WHERE id_follow = :id_follow";
        $stmt = $this->conn->prepare($del);

        $stmt->bindParam(':id_follow', $id_follow);            
       
        if($stmt->execute()){
            return true;
        }               
            return false;            
    }

    function countFriend($id_user){
        $counter= "SELECT COUNT(id_follow) AS countAmis FROM friend WHERE id_follower=: id_user OR id_followed=: id_user";
        $stmt = $this->conn->prepare($counter);
        $stmt->bindParam('id_user', $id_user);
        $stmt->execute();
        $row= $stmt->fetch();
        $this->countFriend = $row['countAmis'];

    }

}