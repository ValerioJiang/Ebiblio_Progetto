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
        public function getPrenotazione($nomeBiblio, $DataPrenotazione, $oraInizio){
            $query = "SELECT * FROM Prenotazione_Posto_Lettura WHERE Biblioteca = '$nomeBiblio' AND DataPrenotazione='$DataPrenotazione'";
            
            $stmt = Dbh:: getInstance()
            -> getDb()
            -> prepare($query);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * CREATE
         */
        public function createPrenotazione($posto, $nomeBiblio, $DataPrenotazione,$oraInizio){
            $Utilizzatore ="ciao@gmaiul.com"; //da cambiare con le sessioni
            if($oraInizio === '9:00:00'){
                $oraFine = '12:00:00';
            }
            else if($oraInizio === '12:00:00'){
                $oraFine = '15:00:00';
            }
            else{
                $oraFine = '18:00:00';
            }
            $query = "INSERT INTO Prenotazione_Posto_Lettura VALUES($posto,'$nomeBiblio', '$Utilizzatore', '$DataPrenotazione' ,'$oraInizio','$oraFine')"; 
            $stmt = Dbh:: getInstance()
            -> getDb()
            -> prepare($query);
            $stmt -> execute();
        }
        

    }
?>