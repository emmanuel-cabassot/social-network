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
    public $text_comment;
    public $date_comment;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function listEvents(){

    // select all query
    $query =  'SELECT id_event, id_user_creator, title_event, text_event, date_event, city_event, img_event, users.name, users.lastname, avatar FROM events JOIN users ON id_user_creator= users.id_user WHERE date_event >= CURDATE() AND public_event = "oui" ' ;

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;

    }

    function suggestEvent($id_user){
        $query = 'SELECT * FROM part_event LEFT JOIN events ON part_event.id_event = events.id_event WHERE id_user IN (SELECT id_user_friend FROM `friend` WHERE id_user =:id_user UNION SELECT id_user FROM friend WHERE id_user_friend = id_user) AND id_event not IN (SELECT id_event FROM part_event where id_user=:id_user) ORDER BY RAND() LIMIT 3';
        $stmt = $this->conn->prepare($query);
         $stmt->bindParam(":id_user", $id_user);
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

    function noPartEvent($id_user, $id_event){
        // Inserer le post

        $noPartEvent="DELETE FROM part_event WHERE id_event=:id_event && id_user=:id_user";

        // prepare the query
        $stmt = $this->conn->prepare( $noPartEvent );

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

    function viewCreate($id_user_creator){
        $query= 'SELECT name, lastname, avatar FROM users WHERE id_user= :id_user_creator';
        // prepare query statement
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id_user_creator", $id_user_creator);
    // execute query
    $stmt->execute();

    return $stmt;
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

    function count_part($id_event){
        $count= "SELECT COUNT(id_user) as count_part FROM part_event WHERE id_event=:id_event ";
        $count =$this->conn->prepare($count);
        $count->bindParam(':id_event', $id_event);
        $count->execute();
        $row= $count->fetch(PDO::FETCH_ASSOC);
        $this->count_part =$row['count_part'];
    }

    function particip_event($id_user, $id_event){
        $part="SELECT id_part_event FROM part_event WHERE id_user=:id_user AND id_event=:id_event";
        $part =$this->conn->prepare($part);
        $part->bindParam(':id_user', $id_user);
        $part->bindParam(':id_event', $id_event);
        $part->execute();
        $num = $part->rowCount();

        // if id_user exists, return true
        if($num > 0){
            return true;
        }else{
             return false;}
    }

    function addEventComment(){
        // query to insert record
        $query = "INSERT INTO comment_event SET id_event=:id_event, id_user=:id_user, text_comment=:text_comment, date_comment=:date_comment";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize

        $this->id_group=htmlspecialchars($this->id_event);
        $this->text_comment=htmlspecialchars($this->text_comment);
        $this->date_comment=htmlspecialchars($this->date_comment);

        // bind values

        $stmt->bindParam(":id_event", $this->id_event);
        $stmt->bindParam(":text_comment", $this->text_comment);
        $stmt->bindParam(":date_comment", $this->date_comment);
        $stmt->bindParam(":id_user", $this->id_user);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    function listEventComment($id_event){

        // select all query
        $query = 'SELECT id_comment_event, text_comment, date_comment, avatar, name, lastname FROM comment_event  LEFT JOIN users ON comment_event.id_user=users.id_user WHERE id_event=:id_event ORDER BY date_comment DESC';

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_event", $id_event);

        // execute query
        $stmt->execute();

        return $stmt;

        }

}
