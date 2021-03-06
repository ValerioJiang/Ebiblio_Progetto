<?php

require_once('/xampp/htdocs/Ebiblio/vendor/autoload.php');

    class Biblioteca{
        public $Nome;
        public $Email;
        public $SitoWeb;
        public $Indirizzo;
        public $Latitudine;
        public $Longitudine;
        public $Note;
    }
    

    class BibliotecaController{

        /**
         * LIST
         */
        public function list(){
            $query = "call getAllBiblio()";

            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * RETRIEVE
         */
        public function getBiblioteca($NomeBiblio){
            $query = "SELECT * FROM Biblioteca WHERE Nome = '$NomeBiblio'";

            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function getLikeBiblioteca($NomeBiblio){
            $query = "SELECT * FROM Biblioteca WHERE LOWER(Nome) LIKE CONCAT"."('%',LOWER('$NomeBiblio'),'%')";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        
        /*
        //funzione per controllare l'esistenza dell'email
        public function getLikeEmail($Email){
            $query = "SELECT * FROM Biblioteca WHERE LOWER(Email) LIKE CONCAT"."('%',LOWER('$Email'),'%')";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }


        //funzione per controllare l'esistenza del sito
        public function getLikeSito($Sito){
            $query = "SELECT * FROM Biblioteca WHERE LOWER(SitoWeb) LIKE CONCAT"."('%',LOWER('$Sito'),'%')";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /*funzione per controllare l'esistenza delle coordinate geografiche
        public function getLikeCoordinate($Latitudine,$Longitudine){
            $query = "SELECT * FROM Biblioteca WHERE (Latitudine == $Latitudine) and (Longitudine == $Longitudine)";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }*/


        //inserimento nuovo autore se autore inserito non ?? presente nel database
        public function createBiblioteca($NomeBiblio,$Email,$SitoWeb,$Indirizzo,$Latitudine,$Longitudine,$Note){
            $query = "INSERT INTO Biblioteca VALUES('$NomeBiblio','$Email','$SitoWeb','$Indirizzo',$Latitudine,$Longitudine,'$Note')";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
            

            
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        
        
        
    }
