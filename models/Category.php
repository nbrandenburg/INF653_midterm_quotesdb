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
            $query = 'SELECT
                id,
                category
            FROM
                ' . $this->table;

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }
    }