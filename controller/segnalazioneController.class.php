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
        public function list(){
            $query = "SELECT * FROM segnalazione";

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

        

    
    }