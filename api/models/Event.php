<?php
class Event{

    // database connection and table name
    private $conn;
    

    // object properties
    public $id_event;
    public $id_user_creator;
    public $id_user;
    public $id_part_event;
    public $title_event;
    public $text_event;
    public $date_event;
    public $city_event;
    public $img_event;
    public $public_event;
    public $signalized;
    public $blocked;
    public $now;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function listEvents(){
       
    // select all query
    $query =  'SELECT id_event, title_event, text_event, date_event, city_event, img_event, users.name, users.lastname, avatar FROM events JOIN users ON id_user_creator= users.id_user WHERE date_event >= CURDATE() AND public_event = "oui" ' ;

    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();

    return $stmt;

    }

    function addEvent(){
         // query to insert record
        $query = "INSERT INTO events SET id_user_creator=:id_user_creator, title_event=:title_event, text_event=:text_event, date_event=:date_event, city_event=:city_event, img_event=:img_event, public_event=:public_event, signalized=:signalized, blocked=:blocked";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
       
        $this->id_user_creator=htmlspecialchars($this->id_user_creator);
        $this->title_event=htmlspecialchars($this->title_event);
        $this->text_event=htmlspecialchars(strip_tags($this->text_event));
        $this->date_event=htmlspecialchars(strip_tags($this->date_event));
        $this->city_event=htmlspecialchars(strip_tags($this->city_event));
        $this->img_event=htmlspecialchars(strip_tags($this->img_event));
        $this->public_event=htmlspecialchars(strip_tags($this->public_event));
        
        // bind values
      
       
        $stmt->bindParam(":id_user_creator", $this->id_user_creator);
        $stmt->bindParam(":title_event", $this->title_event);
        $stmt->bindParam(":text_event", $this->text_event);
        $stmt->bindParam(":date_event", $this->date_event);
        $stmt->bindParam(":city_event", $this->city_event);
        $stmt->bindParam(":img_event", $this->img_event);
        $stmt->bindParam(":public_event", $this->public_event);
        $stmt->bindParam(":signalized", $this->signalized);
        $stmt->bindParam(":blocked", $this->blocked);

    
        // execute query
        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }
    
        return false;
    }

    function partEvent($id_user, $id_event){
        // Inserer le post

        $insert = "INSERT INTO part_event SET id_event=:id_event, id_user=:id_user ";
     
        // prepare the query
        $stmt = $this->conn->prepare( $insert );
     
        // bind user, title, texte
        $stmt->bindParam(':id_event', $id_event);
        $stmt->bindParam(':id_user', $id_user);
      

        // execute the query
         // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function view_event($id_event){
        $view = "SELECT * FROM events WHERE id_event=:id_event";
        // prepare the query
        $stmt = $this->conn->prepare( $view );
     
        // bind user, title, texte
        $stmt->bindParam(':id_event', $id_event);

       $stmt->execute();

            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set values to object properties
            $this->id_event =  $row['id_event'];
            $this->id_user_creator = $row['id_user_creator'];
            $this->title_event = $row['title_event'];
            $this->text_event = $row['text_event'];
            $this->date_event = $row['date_event'];
            $this->city_event = $row['city_event'];
            $this->img_event = $row['img_event'];
            $this->public_event = $row['public_event'];
            $this->signalized = $row['signalized'];
            $this->blocked = $row['blocked'];

            }
    
    function delete_event($id_event){
        
        $del="DELETE FROM events WHERE id_event = :id_event";
        $stmt = $this->conn->prepare( $del );
     
        // bind user, title, texte
        $stmt->bindParam(':id_event', $id_event);

         if($stmt->execute()){
            $del_part_event="DELETE FROM part_event WHERE id_event=:id_event";
            $stmt = $this->conn->prepare( $del_part_event );
              $stmt->bindParam(':id_event', $id_event);

              if($stmt->execute()){
                  return true;
              }
              return false;
        }
        return false;
    }

}


