<?php
    class Connection {
        public $connection;
        // create connection upon creation of an object
        public function __construct() {
            $this->connection = new mysqli ("localhost", "mrlonzanida", "Ily#102518", "phoneBookDB");
            if($this->connection->connect_error) {
                echo "Failed to connect";
            }
        }
        // function on getting the connection
        public function getConnection() {
            return $this->connection;
        }
    }
?>