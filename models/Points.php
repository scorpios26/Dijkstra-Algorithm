<?php 
  class Points {
    // DB stuff
    private $conn;
    private $table = 'points';

    // Post Properties
    public $id;
    public $point1;
    public $point2;
    public $cost;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM points ORDER BY created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM points WHERE id = ?';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id = $row['id'];
          $this->point1 = $row['point1'];
          $this->point2 = $row['point2'];
          $this->created_at = $row['created_at'];
         
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . 
            $this->table . '
            SET 
            point1 = :point1,
            point2 = :point2,
            cost = :cost';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->point1 = htmlspecialchars(strip_tags($this->point1));
          $this->point2 = htmlspecialchars(strip_tags($this->point2));
          $this->cost = htmlspecialchars(strip_tags($this->cost));
          

          // Bind data
          $stmt->bindParam(':point1', $this->point1);
          $stmt->bindParam(':point2', $this->point2);
          $stmt->bindParam(':cost', $this->cost);
          

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET 
                                point1 = :point1, 
                                point2 = :point2, 
                                cost = :cost
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->point1 = htmlspecialchars(strip_tags($this->point1));
          $this->point2 = htmlspecialchars(strip_tags($this->point2));
          $this->cost = htmlspecialchars(strip_tags($this->cost));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':point1', $this->point1);
          $stmt->bindParam(':point2', $this->point2);
          $stmt->bindParam(':cost', $this->cost);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }