<?php
    class Raccolta{
        public $Biblioteca;
        public $Libro;
        public $StatoConservazione;
        public $StatoDisponibilita;
        public $Scaffale;
    }

    class RaccoltaController{
        public function getRaccolta($codLibro){
            $query = "SELECT * FROM Raccolta WHERE Libro = $codLibro AND StatoDisponibilita <> 'Prenotato' AND StatoConservazione <> 'Scadente'";

            $stmt = Dbh:: getInstance()
            -> getDb()
            -> prepare($query);
            $stmt -> execute();
            
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
    


        //caricamento libri da biblioteca gestita da un dato amministratore:
        public function list($Amministratore){
           $query = "SELECT * from cartaceo where cartaceo.codice in(select libro from raccolta where biblioteca in(
                select bibliotecagestita from amministratore where email like '$Amministratore'))";

            $stmt = Dbh:: getInstance()
            -> getDb()
            -> prepare($query);
            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }

     //libri in possesso di una biblioteca gestiti da un dato amministratore:
     public function getLikeLibroAmministratore($Amministratore,$Titolo){
        $query = "SELECT * from cartaceo where LOWER(Titolo) LIKE CONCAT"."('%',LOWER('$Titolo'),'%')"." and  cartaceo.codice in(

            SELECT libro from raccolta where biblioteca in(
            SELECT bibliotecagestita from amministratore where email like '$Amministratore'))";

        $stmt = Dbh::getInstance()
        -> getDb()
        -> prepare($query);

        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

    }
}

?>