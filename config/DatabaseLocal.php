<?php
    class Database {
        private $host = 'localhost';
        private $dbname = 'quotesdb';
        private $username = 'root';
        private $password = '';
        private $conn;

        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
                // echo for tutorial, log for production
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }
    }

    // http://localhost/php_rest_quotes/api/