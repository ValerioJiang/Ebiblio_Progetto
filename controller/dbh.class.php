<?php

    class Dbh {
        private static $dbInstance;
    
        private $db;
    
        public static function getInstance() {
            if(is_null(Dbh::$dbInstance)) {
                self::$dbInstance = new Dbh();
            }
    
            return self::$dbInstance;
        }
    
        private function __construct() {
            try {
                $this->db = new PDO(
                    'mysql:host=localhost;dbname=ebiblio;charset=utf8',
                    'root',
                    '1590');
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            } catch (PDOException $pdo) {
                echo "No database found! Please run the database server to proceed!";
            }
        }
    
        public function getDb() {
            return $this->db;
        }
    
    
    
    }
?>