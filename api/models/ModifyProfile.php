<?php
class ModifyProfile{

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

    function readOneProfil(){
 
        // query to check if email exists
        $query = "SELECT * FROM users WHERE id_user=:id_user";
     
        // prepare the query
        $stmt = $this->conn->prepare( $query );

        $id_user = $_SESSION['id_user'];
     
        // bind given email value
        $stmt->bindParam(":email", $id_user);
     
        // execute the query
        $stmt->execute();

        $row =$stmt->fetch(PDO::FETCH_ASSOC);
        $this->email=$row['email'];
        $this->name = $row['name'];
        $this->lastname =$row['lastname'];
        $this->city= $row['city'];
        $this->country= $row['country'];
        $this->birth=$row['birth'];
        $this->avatar=$row['avatar'];
        $this->banner=$row['banner'];
       
    }

    function modifProfil(){

        // query to update record
        $query = "UPDATE users SET email=:email, password=:password, name=:name, lastname=:lastname, avatar=:avatar, city=:city, country=:country, birth=:birth, banner=:banner";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
       
        $this->email=htmlspecialchars($this->email);
        $this->password=htmlspecialchars($this->password);
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
        $stmt->bindParam(":banner", $this->banner);

        
        
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    
    }
} 