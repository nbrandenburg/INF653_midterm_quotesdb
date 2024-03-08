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

        // Get categories
        public function read() {
            // Create query
            $query = 'SELECT
                id,
                category,
                author_id,
                category_id
            FROM
                ' . $this->table;

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }
    }