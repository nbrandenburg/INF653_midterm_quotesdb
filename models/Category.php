<?php
    class Category {
        // Database
        private $conn;
        private $table = 'categories';

        // Properties
        public $id;
        public $category;

        // Constructor with Database
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get categories
        public function read() {

            // Create query
            $query = 'SELECT id, category
                      FROM ' . $this->table;

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Category
        public function read_single() {
            // Create query
            $query = 'SELECT id, category
                    FROM ' . $this->table . 
                    ' WHERE id = :id ';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(':id', $this->id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set category if one exists, otherwise null
            $this->category = $row['category'] ?? NULL;
        }

        // Create Category
        public function create() {
            // Create Query
            $query = 'INSERT INTO ' . $this->table . '
                    SET category = :category';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->category = htmlspecialchars(strip_tags($this->category));

            // Bind data
            $stmt-> bindParam(':category', $this->category);

            // Execute query
            return $stmt->execute() ? true : false;
        }

        // Update Category
        public function update() {
            // Create Query
            $query = 'UPDATE ' . $this->table . '
                    SET category = :category
                    WHERE id = :id';
    
            // Prepare Statement
            $stmt = $this->conn->prepare($query);
    
            // Clean data
            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            // Bind data
            $stmt-> bindParam(':category', $this->category);
            $stmt-> bindParam(':id', $this->id);
    
            // Execute query
            return $stmt->execute() ? true : false;
        } 
        
        // Delete Category
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    
            // Prepare Statement
            $stmt = $this->conn->prepare($query);
    
            // clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            // Bind Data
            $stmt-> bindParam(':id', $this->id);
    
            // Execute query
            return $stmt->execute() ? true : false;        }  
    }