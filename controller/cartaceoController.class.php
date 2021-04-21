<?php
    class Cartcaeo{
        public $Codice;
        public $Titolo; 
        public $Autore;
        public $Edizione; 
        public $Genere;
        public $AnnoPubblicazione; 

        /*public $libroCod;
        public $autoreCod;*/
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

    //creare nuovo libro cartaceo
    public function createCartaceo($Titolo,$Edizione,$Genere,$AnnoPubblicazione){
        
        $query = "INSERT INTO cartaceo(Titolo,Edizione,Genere,AnnoPubblicazione) VALUES ('$Titolo','$Edizione','$Genere',$AnnoPubblicazione)";
        $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
        $stmt-> execute();
        
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

    }
    
    //inserimento dati in autore_libro
    public function getCodiceLibro($Titolo,$Edizione){
        $query = " SELECT * FROM CARTACEO where LOWER(Titolo) LIKE CONCAT"."('%',LOWER('$Titolo'),'%') and
        LOWER(Edizione) LIKE CONCAT"."('%',LOWER('$Edizione'),'%')" ;        
        $stmt = Dbh::getInstance()
        ->getDb()
        ->prepare($query);
        $stmt-> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC) ;
   
    }

    
    public function getCodiceAutore($Nome,$Cognome){       
       $query = "SELECT * FROM AUTORE where LOWER(Cognome) LIKE CONCAT"."('%',LOWER('$Cognome'),'%') and
        LOWER(nome) LIKE CONCAT"."('%',LOWER('$Nome'),'%')" ;
        $stmt = Dbh::getInstance()
        ->getDb()
        ->prepare($query);
        $stmt-> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
   
    }

    public function createAutore_libro($codLibro,$codAutore){
        $query = "INSERT INTO autore_libro values($codLibro,$codAutore)";
        
        $stmt = Dbh::getInstance()
        ->getDb()
        ->prepare($query);
        $stmt-> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

    }


    //eliminazione 
    public function deleteCartaceo($Codice){
       $query =" DELETE from cartaceo where cartaceo.codice =  $Codice";
    
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
       }
    }

?>