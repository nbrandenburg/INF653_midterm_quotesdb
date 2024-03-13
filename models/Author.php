<?php
    class Author {
      // Database
      private $conn;
      private $table = 'authors';

      // Properties
      public $id;
      public $author;

      // Constructor with Database
      public function __construct($db) {
          $this->conn = $db;
      }

      // Get Authors
      public function read() {
        // Create query
        $query = ' SELECT id, author
                   FROM ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
      }

      // Get Single Author
      public function read_single($id) {
        // Create query
        $query = 'SELECT id, author
                  FROM ' . $this->table . 
                  ' WHERE id = :id
                    OR author = :author ';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':author', $this->author);

        // Execute query
        $stmt->execute();

        // Get row count
        $num = $stmt->rowCount();

        // Check if any Authors
        if($num > 0) {
          $author_arr = array();

          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              extract($row);

              $author_arr = array(
                  'id' => $id,
                  'author' => $author
              );
          }

          return $author_arr;
            
        } else {
          // No Authors
          return array('message' => 'author_id Not Found');
        }
      }

      // Create Author
      public function create() {
        // Create Query
        $query = 'INSERT INTO ' .
          $this->table . '
        SET author = :author';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));

        // Bind data
        $stmt-> bindParam(':author', $this->author);

        // Execute query
         return $stmt->execute() ? true : false;
      } 

    // Update Author
    public function update() {
      // Create Query
      $query = 'UPDATE ' . $this->table . '
                SET author = :author
                WHERE id = :id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Bind data
      $stmt-> bindParam(':author', $this->author);
      $stmt-> bindParam(':id', $this->id);

      // Execute query
      return $stmt->execute() ? true : false;
    }

    // Delete Author
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . 
              ' WHERE id = :id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Bind Data
      $stmt-> bindParam(':id', $this->id);

      // Execute query
      return $stmt->execute() ? true : false;
    }  
  }