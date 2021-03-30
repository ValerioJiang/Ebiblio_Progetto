<?php
    class PrenotazionePostoLettura{
        public $Posto;
        public $Biblioteca;
        public $Utilizzatore;
        public $DataPrenotazione;
        public $Inizio; 
        public $Fine; 
    }

    class PrenotazionePostoLetturaController{

        /**
         * LIST
         */
        public function getPrenotazione($nomeBiblio){
            $query = "SELECT * FROM Prenotazione_Posto_Lettura WHERE Biblioteca = '$nomeBiblio'";
            $stmt = Dbh:: getInstance()
            -> getDb()
            -> prepare($query);
            $stmt = $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * CREATE
         */
        public function createPrenotazione($nomeBiblio){

        }
        

    }
?>