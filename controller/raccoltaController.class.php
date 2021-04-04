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
            $query = "SELECT * FROM Raccolta WHERE Libro = $codLibro";

            $stmt = Dbh:: getInstance()
            -> getDb()
            -> prepare($query);
            $stmt -> execute();
            
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>