<?php
    class Cartcaeo{
        public $Codice;
        public $Titolo; 
        public $Autore;
        public $Edizione; 
        public $Genere;
        public $AnnoPubblicazione; 
    }

    class CartaceoController{
        /**
         * LIST
         */
        public function list(){
            $query="SELECT * FROM Cartaceo";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * RETRIEVE
         */
        public function getLikeLibro($tit){
            $query="SELECT * FROM Cartaceo WHERE LOWER(Titolo) LIKE CONCAT"."('%',LOWER('$tit'),'%')";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
    
    }
?>