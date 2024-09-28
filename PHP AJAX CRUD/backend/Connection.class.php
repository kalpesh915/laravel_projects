<?php
    class Connection{
        private $hostname = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "ajaxcrud";
        public $connection = null;

        public function __construct(){
            $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);

            if($this->connection->connect_error){
                die("Unable to Connect with Database Server ".$this->connection->connect_error);
            }
        }

        public function filterData($input){
            $input = trim($input);
            $input = htmlspecialchars($input);
            $input = stripslashes($input);
            return $input;
        }
    }
?>