<?php
class Profil{

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

    

    function viewProfil($id_profil){
        $query= 'SELECT * FROM users WHERE id_user= :id_profil';
         // prepare query statement
       $stmt = $this->conn->prepare($query);
       $stmt->bindParam(":id_profil", $id_profil);
       // execute query
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
        $this->blocked=$row['blocked'];
        $this->period_block=$row['period_block'];
       
    }

    function modifyProfil($id_user){

        // query to update record
        $query = "UPDATE users SET email=:email, password=:password, name=:name, lastname=:lastname, city=:city, country=:country, birth=:birth WHERE id_user=:id_user";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
       
        $this->email=htmlspecialchars($this->email);
        $this->password=htmlspecialchars($this->password);
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->city=htmlspecialchars(strip_tags($this->city));
        $this->country=htmlspecialchars(strip_tags($this->country));
        $this->birth=htmlspecialchars(strip_tags($this->birth));
       
        // bind values
      
        $stmt->bindParam(":email", $this->email);

        // hash the password before saving to database
        $options = array("cost" => 4);
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT, $options);
        $stmt->bindParam(":password", $password_hash);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":country", $this->country);
        $stmt->bindParam(":birth", $this->birth);
        $stmt->bindParam(":id_user", $id_user);

        
        
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    
    }

    function modifyAvatar($id_user){

        // query to update record
        $query = "UPDATE users SET  avatar= :avatar WHERE id_user=:id_user";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
       
        $this->avatar=htmlspecialchars($this->avatar); 
        
        // bind values
        $stmt->bindParam(":avatar", $this->avatar);
        $stmt->bindParam(":id_user", $id_user);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    
    }



   }


