<?php
    require_once('/xampp/htdocs/Ebiblio/vendor/autoload.php');
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
        public function createPrenotazione($Utilizzatore, $posto, $nomeBiblio, $DataPrenotazione,$oraInizio){
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
            echo $query;
            $stmt -> execute();

            $client = new MongoDB\Client("mongodb://localhost:27017");
  
            $companydb = $client -> ebiblio;
                    
            $log_events = $companydb -> log_events;
                    
            $insertOneResult = $log_events -> insertOne(['Utente' => $Utilizzatore, 'Evento' => 'Prenotazione Posto Lettura', 'TipologiaUtente' =>'Utilizzatore', 'Timestamp' => date("Y-m-d h:i:sa")]);
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * RETRIEVE
         */
        public function getPostoLetturaUtil($Util){
            $query="SELECT * FROM PRENOTAZIONE_POSTO_LETTURA WHERE UTILIZZATORE = '$Util' ORDER BY DataPrenotazione desc";
            $stmt = Dbh:: getInstance()
                -> getDb()
                -> prepare($query);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }


        public function getPrenotazioneAdmin($admin){
            $query="SELECT * from prenotazione_posto_lettura where biblioteca in
            (select bibliotecagestita from amministratore where email like'$admin')";
         
            $stmt = Dbh:: getInstance()
            -> getDb()
            -> prepare($query);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }


        public function createStatisticaPosto($Denominatore,$Biblioteca){
            /*
           $query= "SELECT *, (count(*)/$Denominatore)*100 as percentuale
           from prenotazione_posto_lettura
           where posto  in
           (select numero
           from posto_lettura where biblioteca not like'$Biblioteca' )
           group by biblioteca
           order by percentuale";*/

           $query = "SELECT *, 100-(count(*)/$Denominatore)*100 as percentuale
           from posto_lettura
           where numero not in
           (select posto 
           from prenotazione_posto_lettura where biblioteca not like '$Biblioteca')
           group by biblioteca
           order by percentuale";
           
        
            $stmt = Dbh:: getInstance()
            -> getDb()
            -> prepare($query);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);


        }
        

    }
?>