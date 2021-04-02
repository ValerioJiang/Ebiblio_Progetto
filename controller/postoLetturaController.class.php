<?php
    class PostoLettura{
        public $Numero;
        public $Biblioteca;
        public $ReteEthernet;
        public $PresaCorrente;
    }

    class PostoLetturaController{
        /**
         * RETRIEVE
         */
        public function getPostoLettura($NomeBiblio, $Data, $PresaCorrente, $ReteEthernet, $OraInizio){
            
            if($PresaCorrente !== '' && $ReteEthernet !==''){
                $query = "select * from posto_lettura where Biblioteca = '$NomeBiblio' and PresaCorrente = $PresaCorrente and ReteEthernet = $ReteEthernet and numero not in ( select posto from prenotazione_posto_lettura where dataprenotazione = '$Data' And Inizio <= '$OraInizio')";
            }
            else{
                if($PresaCorrente !== ''){
                    $query = "select * from posto_lettura where Biblioteca = '$NomeBiblio' and PresaCorrente = $PresaCorrente and numero not in ( select posto from prenotazione_posto_lettura where dataprenotazione = '$Data' And Inizio <= '$OraInizio')";
                }
                else if($ReteEthernet !==''){
                    $query = "select * from posto_lettura where Biblioteca = '$NomeBiblio' and ReteEthernet = $ReteEthernet and numero not in ( select posto from prenotazione_posto_lettura where dataprenotazione = '$Data' And Inizio <= '$OraInizio')";
                }
                else{
                    $query = "select * from posto_lettura where Biblioteca = '$NomeBiblio' and numero not in ( select posto from prenotazione_posto_lettura where dataprenotazione = '$Data' And Inizio <= '$OraInizio')";
                }
            }
            
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);
        
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
          
        }
    }
?>