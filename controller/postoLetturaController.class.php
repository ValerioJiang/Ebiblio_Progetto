<?php
    require_once('/xampp/htdocs/Ebiblio/vendor/autoload.php');
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
            $oraFine = date("H:i:s", strtotime("{$OraInizio}+3 hours"));

            if($PresaCorrente !== '' && $ReteEthernet !==''){
                $query = "select * from posto_lettura where Biblioteca = '$NomeBiblio' and PresaCorrente = $PresaCorrente and ReteEthernet = $ReteEthernet and numero not in ( select posto from prenotazione_posto_lettura where dataprenotazione = '$Data' And Inizio ='$OraInizio' AND Fine ='$oraFine' AND Biblioteca ='$NomeBiblio')";
            }
            else{
                if($PresaCorrente !== ''){
                    $query = "select * from posto_lettura where Biblioteca = '$NomeBiblio' and PresaCorrente = $PresaCorrente and numero not in ( select posto from prenotazione_posto_lettura where dataprenotazione = '$Data' And Inizio ='$OraInizio' AND Fine ='$oraFine' AND Biblioteca ='$NomeBiblio')";
                }
                else if($ReteEthernet !==''){
                    $query = "select * from posto_lettura where Biblioteca = '$NomeBiblio' and ReteEthernet = $ReteEthernet and numero not in ( select posto from prenotazione_posto_lettura where dataprenotazione = '$Data' And Inizio ='$OraInizio' AND Fine ='$oraFine' AND Biblioteca ='$NomeBiblio')";
                }
                else{
                    $query = "select * from posto_lettura where Biblioteca = '$NomeBiblio' and numero not in ( select posto from prenotazione_posto_lettura where dataprenotazione = '$Data'And Inizio ='$OraInizio' AND Fine ='$oraFine' AND Biblioteca ='$NomeBiblio')";
                }
            }
            
            
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
          
        }

        public function list($NomeBiblio){
            $query="SELECT * FROM Posto_Lettura WHERE Biblioteca like'$NomeBiblio'";
            
            
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);
        
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
          
        }


        public function getDenominatoreStatistica(){
            $query = "SELECT *, count(numero) as den
            from biblioteca join posto_lettura on nome = biblioteca
            group by biblioteca";

            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);
        
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            
        }


        


    }
?>