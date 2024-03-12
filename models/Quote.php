<?php
    class Quote {
        // Database
        private $conn;
        private $table = 'quotes';

        // Properties
        public $id;
        public $quote;
        public $author_id;
        public $category_id;

        // Constructor with Database
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Quotes
        public function read() {
            // Create query
            $query = 'SELECT 
                        q.id,
                        q.quote,
                        a.author,
                        c.category
                      FROM ' . $this->table . ' q
                      INNER JOIN authors a ON a.id = q.author_id
                      INNER JOIN categories c ON c.id = q.category_id
                      ORDER BY q.id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Quote
        public function read_single() {
            //Create query
            $query = 'SELECT 
                        q.id,
                        q.quote,
                        a.author,
                        c.category
                      FROM ' . $this->table . ' q
                      INNER JOIN authors a ON a.id = q.author_id
                      INNER JOIN categories c ON c.id = q.category_id
                      WHERE q.id = :id
                      OR a.id = :author_id
                      OR c.id = :category_id ';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind data
            $stmt-> bindParam(':id', $this->id);
            $stmt-> bindParam(':author_id', $this->author_id);
            $stmt-> bindParam(':category_id', $this->category_id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set properties
            $this->id = $row['id'];
            $this->quote = $row['quote'] ?? NULL;
            $this->author = $row['author'] ?? NULL;
            $this->category = $row['category'] ?? NULL;
            $this->author_id = $row['author_id'] ?? NULL;
            $this->category_id = $row['category_id'] ?? NULL;

            return $stmt;
        } 
        
        // Create Quote
        public function create() {
            // Create Query
            $query = 'INSERT INTO ' . $this->table . '
                    SET quote = :quote, 
                    author_id = :author_id, 
                    category_id = :category_id ';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // Bind data
            $stmt-> bindParam(':quote', $this->quote);
            $stmt-> bindParam(':author_id', $this->author_id);
            $stmt-> bindParam(':category_id', $this->category_id);

            // Execute query
            return $stmt->execute() ? true : false;
        }
        
        // Update Quote
        public function update() {
            // Create Query
            $query = 'UPDATE ' . $this->table . '
                    SET quote = :quote
                    WHERE id = :id';
            // Prepare Statement
            $stmt = $this->conn->prepare($query);
    
            // Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            // Bind data
            $stmt-> bindParam(':quote', $this->quote);
            $stmt-> bindParam(':id', $this->id);
    
            // Execute query
            return $stmt->execute() ? true : false;
        }
        
        // Delete Quote
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
            return $stmt->execute() ? true : false;
        }  
    }