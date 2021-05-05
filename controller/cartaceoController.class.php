<?php
require_once('/xampp/htdocs/Ebiblio/vendor/autoload.php');
    class Cartcaeo{
        public $Codice;
        public $Titolo; 
        public $Autore;
        public $Edizione; 
        public $Genere;
        public $AnnoPubblicazione; 
        public $NumeroPagine; 
        public $StatoConservazione; 
        public $StatoDisponibilita;
        public $Scaffale; 
        public $Biblioteca;

    }

    class CartaceoController{
        
        /**
         * LIST
         */
        public function list(){
            $query=" SELECT * from cartaceo ";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function list_admin($Amministratore){
            $query=" SELECT * from cartaceo where Biblioteca in
            (select Bibliotecagestita from amministratore where email like '$Amministratore')";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function listUtil(){
            $query=" SELECT * from Cartaceo where statoconservazione not like 'Scadente'";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }


        /*
        /**
         * RETRIEVE
         */
       
        public function getLikeLibro($Titolo,$Amministratore){
            $query="SELECT * FROM Cartaceo WHERE LOWER(Titolo) LIKE CONCAT"."('%',LOWER('$Titolo'),'%')"." and Biblioteca in
            (select BibliotecaGestita from amministratore where email like '$Amministratore')";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function getLikeLibroUtil($Titolo){
            $query="SELECT * FROM Cartaceo WHERE LOWER(Titolo) LIKE CONCAT"."('%',LOWER('$Titolo'),'%')";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        

        public function getLikeLibroConsegna($codPrestito){
            $query="SELECT * FROM Cartaceo WHERE Codice in (SELECT Libro From Prestito where Codice = $codPrestito)";
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



        //controllo esistenza libro
        public function controlloLibro($Titolo,$Nome,$Cognome,$AnnoPubblicazione,$Edizione,$Genere){
        $query =  "SELECT * from cartaceo join autore_libro on cartaceo.codice = libro  WHERE LOWER(titolo) LIKE CONCAT('%',LOWER('$Titolo'),'%') and LOWER(edizione) LIKE CONCAT('%',LOWER('$Edizione'),'%') and  LOWER(genere) LIKE CONCAT('%',LOWER('$Genere'),'%') and annopubblicazione = $AnnoPubblicazione and autore in( select codice from autore where LOWER(nome) LIKE CONCAT('%',LOWER('$Nome'),'%') and  LOWER(cognome) LIKE CONCAT('%',LOWER('$Cognome'),'%'))";
    
        $stmt = Dbh::getInstance()
        -> getDb()
        -> prepare($query);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        

        //creare nuovo libro cartaceo
        public function createCartaceo($Titolo,$Edizione,$Genere,$AnnoPubblicazione,$NumPagine,$StatoConservazione,$Scaffale,$Biblioteca){
            
            $query = "INSERT INTO cartaceo(Titolo,Edizione,Genere,AnnoPubblicazione,NumeroPagine,StatoConservazione,StatoPrestito,Scaffale,Biblioteca) VALUES ('$Titolo','$Edizione','$Genere',$AnnoPubblicazione,$NumPagine,'$StatoConservazione','Disponibile','$Scaffale','$Biblioteca')";
            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
        
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }

        public function getById($codLibro){
            $query = " SELECT * FROM CARTACEO where Codice = $codLibro";        
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC) ;
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

        //controllo esistenza libro
        public function getCartaceo($Codice){
        $query = "SELECT * FROM CARTACEO where codice = $Codice";

            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
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
        $query = " DELETE FROM cartaceo WHERE codice = $Codice";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        

        /*
        **MODIFICA LIBRO
        */
        public function getLikeTitolo($Codice){
            $query = "SELECT Titolo from cartaceo where cartaceo.codice like $Codice";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }

        public function updateTitolo($Codice,$TitoloNuovo){
            $query = "UPDATE cartaceo set titolo = '$TitoloNuovo' where codice = $Codice";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateAutore($Codice,$AutoreNuovo){
            $query = "UPDATE cartaceo set Autore = '$AutoreNuovo' where codice = $Codice";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function updatePagine($Codice,$PagineNuovo){
            $query = "UPDATE cartaceo set NumeroPagine = '$PagineNuovo' where codice = $Codice";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateScaffale($Codice,$ScaffaleNuovo){
            $query = "UPDATE cartaceo set Scaffale = '$ScaffaleNuovo' where codice = $Codice";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateEdizione($Codice,$EdizioneNuovo){
            $query = "UPDATE cartaceo set edizione = '$EdizioneNuovo' where codice = $Codice";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateGenere($Codice,$GenereNuovo){
            $query = "UPDATE cartaceo set genere = '$GenereNuovo' where codice = $Codice";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateAnno($Codice,$AnnoNuovo){
            $query = "UPDATE cartaceo set annopubblicazione = $AnnoNuovo where codice = $Codice";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function updateStato($Codice,$StatoNuovo){
            $query = "UPDATE cartaceo set StatoConservazione = '$StatoNuovo' where codice = $Codice";
            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function getLikeBiblioteca($Amministratore){
            $query = "SELECT bibliotecagestita from amministratore where email like '$Amministratore'";

            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }


      
        
        
    }

?>