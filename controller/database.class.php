<?php
    class Dbh{

        private $host = "localhost";
        private $user = "root";
        private $pwd = "root";
        private $dbName = "ebiblio";
        protected function connect(){
            $dsn = "host=".$this -> host.";dbname=".$this ->dbName; 
            $pdo = new PDO($dsn, $this -> user, $this -> pwd);
            return $pdo;
        }
    }
?>