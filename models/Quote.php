<?php
    class Quote {
        // Database
        private $conn;
        private $table = 'quotes';

        // Quote Properties
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
            $query = 'SELECT id, quote, author_id, category_id FROM ' . $this->table;

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Quote
        public function read_single() {
            // Create query
            $query = 'SELECT id, quote, author_id, category_id FROM ' . $this->table . 
                     ' WHERE id = ? 
                       LIMIT 0, 1 ';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->quote = $row['quote'] ?? 'default';
        }

        // Create Quote
        public function create() {
            // Create Query
            $query = 'INSERT INTO ' .
            $this->table . '
            SET
            quote = :quote';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));

            // Bind data
            $stmt-> bindParam(':quote', $this->quote);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: $s.\n", $stmt->error);

            return false;
        }
                
        // Update Quote
        public function update() {
            // Create Query
            $query = 'UPDATE ' .
            $this->table . '
            SET
            quote = :quote
            WHERE
            id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt-> bindParam(':quote', $this->quote);
            $stmt-> bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: $s.\n", $stmt->error);

            return false;
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
            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
            printf("Error: $s.\n", $stmt->error);

            return false;
        }        
    }