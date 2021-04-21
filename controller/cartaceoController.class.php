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
    
    /*
    //aggiunta nuovi elementi in autore_libro
    public function createAutore_libro($Titolo,$Nome,$Cognome){
        $libroCod = "SELECT  cartaceo.codice from cartaceo where LOWER(Titolo) LIKE CONCAT"."('%',LOWER('$Titolo'),'%')";
        $stmt1 = Dbh::getInstance()
        ->getDb()
        ->prepare($libroCod);
    $stmt1-> execute();
    return $stmt1 -> fetchAll(PDO::FETCH_ASSOC);
    
    $autoreCod = "SELECT autore.codice FROM AUTORE where LOWER(Cognome) LIKE CONCAT"."('%',LOWER('$Cognome'),'%')"."and LOWER(Nome) LIKE CONCAT"."('%',LOWER('$Nome'),'%')";
    $stmt2 = Dbh::getInstance()
        ->getDb()
        ->prepare($autoreCod);
        $stmt2-> execute();
        return $stmt2 -> fetchAll(PDO::FETCH_ASSOC);

        $query = "INSERT INTO autore_libro VALUES($libroCod,$autoreCod)";
        $stmt3 = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
        $stmt3-> execute();
        return $stmt3 -> fetchAll(PDO::FETCH_ASSOC);


    }

    
    */

    //eliminazione 
    public function deleteCartaceo($Codice,$Titolo,$Genere,$Edizione,$AnnoPubblicazione){
       $query =" DELETE from cartaceo where $Codice in (
            select cartaceo.codice from cartaceo where (titolo like('$Titolo)) and(edizione like('$Edizione')) and(genere like ('$Genere)) and (AnnoPubblicazione = $AnnoPubblicazione))";
    
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
       }
    }

?>