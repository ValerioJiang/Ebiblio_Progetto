<?php

    require 'vendor/autoload.php';

    class AutoreEbook{
        public $Ebook;
        public $Autore;
    }

    class AutoreEbookController{

        /**
         * CREATE
         */
        public function createAutEbook($aut, $codEbook){
            $query="INSERT INTO AUTORE_EBOOK VALUES($aut, $codEbook)";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        
    }
?>