<?php
class Group{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id_group;
    public $name_group;
    public $description;
    public $img_group;
    public $id_user;
    public $id_belong;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function listGroups($id_group){

    // select all query
    $query = 'SELECT * FROM groupe LIMIT 20 OFFSET 20';

    // prepare query statement
    $stmt = $this->conn->prepare($query);
        
    // execute query
    $stmt->execute();

    return $stmt;

    }

    function addGroup(){
        // query to insert record
        $query = "INSERT INTO groupe SET name_group=:name_group, description=:description, img_group=:img_group";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
       
        $this->name_group=htmlspecialchars($this->name_group);
        $this->description=htmlspecialchars($this->description);
        $this->img_group=htmlspecialchars(strip_tags($this->img_group));
                
        // bind values
      
        $stmt->bindParam(":name_group", $this->name_group);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":img_group", $this->img_group);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    
    }

    function belong($id_user, $id_group){
        // query to insert record
        $query = "INSERT INTO belong SET id_group=:id_group, id_user=:id_user";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // bind values
    
        $stmt->bindParam(":id_group", $id_group);        
        $stmt->bindParam(":id_user", $id_user);
        
        // execute query
        if($stmt->execute()){
            return true;
        }    
        return false;
        
    }

    function viewGroup($id_group){
        $view= "SELECT * FROM groupe WHERE id_group=:id_group";

        // prepare query statement
        $stmt = $this->conn->prepare($view);

        $stmt->bindParam(':id_group', $id_group);
            
       // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->id_group = $row['id_group'];
        $this->name_group = $row['name_group'];
        $this->description = $row['description'];
        $this->img_group = $row['img_group'];
        
    }

    function delete_group($id_group){        
        $del= " DELETE FROM groupe WHERE id_group = :id_group";
        $stmt = $this->conn->prepare($del);

        $stmt->bindParam(':id_group', $id_group);
            
        // execute query
        if($stmt->execute()){
            $del_belong="DELETE FROM belong WHERE id_group=:id_group";
            $stmt = $this->conn->prepare($del_belong);
            $stmt->bindParam(':id_group', $id_group);

            if($stmt->execute()){
                return true;
            }               
             return false;
        }
        return false;        
    }


}