<?php
class SignUp{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id;
    public $email;
    public $password;
    public $name;
    public $lastname;
    public $avatar;
    public $city;
    public $country;
    public $birth;
    public $creation;
    public $role;
    public $blocked;
    public $period_block;
    public $banner;

   

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function emailExists(){
 
        // query to check if email exists
        $query = "SELECT id, email 
                FROM users
                WHERE email = ?
                LIMIT 0,1";
     
        // prepare the query
        $stmt = $this->conn->prepare( $query );
     
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
     
        // bind given email value
        $stmt->bindParam(1, $this->email);
     
        // execute the query
        $stmt->execute();
     
        // get number of rows
        $num = $stmt->rowCount();
     
        // if email exists, return true
        if($num>0){
            return true;
        }else{
             return false;}
        // return false if email does not exist in the database
   
    }

    function create_user(){

        // query to insert record
        $query = "INSERT INTO
                    users
                SET
                 email=:email, password=:password, name=:name, lastname=:lastname, avatar=:avatar, city=:city, country=:country, birth=:birth, creation=:creation, role=:role, blocked=:blocked, period_block=:period_block, banner=:banner";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
       
        $this->email=htmlspecialchars($this->email);
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->avatar=htmlspecialchars(strip_tags($this->avatar));
        $this->city=htmlspecialchars(strip_tags($this->city));
        $this->country=htmlspecialchars(strip_tags($this->country));
        $this->banner=htmlspecialchars(strip_tags($this->banner));
        
        // bind values
      
        $stmt->bindParam(":email", $this->email);

        // hash the password before saving to database
        $options = array("cost" => 4);
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT, $options);
        $stmt->bindParam(":password", $password_hash);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":avatar", $this->avatar);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":country", $this->country);
        $stmt->bindParam(":birth", $this->birth);
        $stmt->bindParam(":creation", $this->creation);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":blocked", $this->blocked);
        $stmt->bindParam(":period_block", $this->period_block);
        $stmt->bindParam(":banner", $this->banner);

        
        
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    
    }
} 