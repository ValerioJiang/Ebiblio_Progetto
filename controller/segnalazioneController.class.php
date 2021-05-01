<?php
    /** Per visualizzare i dati
     * $testObj = new BibliotecaController();
     * $res = $testObj -> getBiblioteca();
     *   
     * echo '<pre>', var_dump($res) , '</pre>';
     * for($i = 0; $i < count($res);$i++){
     *     foreach($res[$i] as $r){
     *         echo ($r);
     *      }
     *     echo '<br>';
     *   }
     */
    require_once('/xampp/htdocs/Ebiblio/vendor/autoload.php');
    class Segnalazione{
        public $Amministratore;
        public $Utilizzatore;
        public $DataSegnalazione;
        public $Note;
        
    }
    

    class SegnalazioneController{

        /**
         * LIST
         */
        public function list($Amministratore){
            $query = "SELECT * FROM segnalazione where amministratore like '$Amministratore'";

            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }


        public function createSegnalazione($Utilizzatore,$Amministratore,$Note){

            $query = "INSERT into  Segnalazione values('$Amministratore','$Utilizzatore',now(),'$Note')";

            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteSegnalazione($Utilizzatore){
            $query = "DELETE from segnalazione where utilizzatore = '$Utilizzatore'";

            $stmt = Dbh::getInstance()
            ->getDb()
            ->prepare($query);
            $stmt-> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

           


        }

        

    
    }