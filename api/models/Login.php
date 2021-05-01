<?php
class Login{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id;
    public $email;
    public $password;
   

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function emailExists(){
 
        // query to check if email exists
        $query = "SELECT id_user, email, password 
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
     
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
     
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
            // assign values to object properties
            
    
            $this->id = $row['id'];
            $this->email = $row['email'];
            $this->password = $row['password'];
     
            // return true because email exists in the database
            return true;
        }
        // return false if email does not exist in the database
    return false;
    }
}  
