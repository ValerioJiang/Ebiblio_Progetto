<?php
require 'vendor/autoload.php';
    class Telefono{
        public $NomeBiblioteca;
        public $NumeroTelefono;
    }

    class TelefonoController{
        
        /**
         * LIST
         */
        public function list(){
            $query = "SELECT * FROM Telefono";

            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * RETRIEVE
         */
        public function getTelefono($NomeBiblio){
            $query = "SELECT * FROM Telefono WHERE NomeBiblioteca= '$NomeBiblio'";

            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }
        
    }
?>