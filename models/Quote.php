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

        // GET
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

        // GET_SINGLE
        public function read_single($id) {
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
            $stmt-> bindParam(':id', $id);
            $stmt-> bindParam(':author_id', $this->author_id);
            $stmt-> bindParam(':category_id', $this->category_id);

            // Execute query
            $stmt->execute();

        // Get row count
        $num = $stmt->rowCount();

        // Check if any quotes
        if($num > 0) {
          $quote_arr = array();

          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              extract($row);

              $quote_arr = array(
                  'id' => $id,
                  'quote' => $quote,
                  'author' => $author,
                  'category' => $category
              );
          }

          return $quote_arr;
            
        } else {
          // No quotes
          return array('message' => 'No Quotes Found');
        }
      }
        
        // CREATE
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
            $stmt-> bindParam(':quote', $this->quote) ?? die();
            $stmt-> bindParam(':author_id', $this->author_id) ?? die();
            $stmt-> bindParam(':category_id', $this->category_id) ?? die();

            // Execute query
            return $stmt->execute() ? true : false;
        }
        
        // UPDATE
        public function update() {
            // Create Query
            $query = 'UPDATE ' . $this->table . '
                      SET quote = :quote, 
                          author_id = :author_id, 
                          category_id = :category_id 
                          WHERE id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);
    
            // Bind data
            $stmt-> bindParam(':quote', $this->quote);
            $stmt-> bindParam(':id', $this->id);
            $stmt-> bindParam(':author_id', $this->author_id);
            $stmt-> bindParam(':category_id', $this->category_id);
    
            // Execute query
            return $stmt->execute() ? true : false;
        }
        
        // DELETE
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