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

        //controllo esistenza autore(cartaceo)
        public function getLikeAutoreCartaceo($Nome,$Cognome){
        $query = "SELECT * FROM AUTORE where LOWER(Cognome) LIKE CONCAT"."('%',LOWER('$Cognome'),'%')"."and LOWER(Nome) LIKE CONCAT"."('%',LOWER('$Nome'),'%')";
        $stmt = Dbh::getInstance()
        -> getDb()
        -> prepare($query);

        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    //creare nuovo autore libro
    public function createAutore($Nome,$Cognome){
        $query = "INSERT INTO Autore(Nome,Cognome) VALUES('$Nome','$Cognome')";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
        $stmt-> execute();
        

        
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

            
    
    }
?>