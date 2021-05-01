<?php
    require 'vendor/autoload.php';
    
    class Autore_Libro{
        public $Libro;
        public $Autore;
    }

    class AutoreLibroController{
        /**
         * CREATE
         */
        public function createAutLib($codAut, $codLibro){
            $query ="INSERT INTO AUTORE_LIBRO VALUES($codLibro,$codAut)";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
            
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

    
    }

?>