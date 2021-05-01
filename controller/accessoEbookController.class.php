<?php

    require_once('/xampp/htdocs/Ebiblio/vendor/autoload.php');
    
    class AccessoEbook{
        public $Ebook; 
        public $Utilizzatore; 
        public $DataAccesso; 
        
    }

    class AccessoEbookController{
        /**
         * LIST
         */
        public function list(){
            $query ="SELECT * FROM Accesso_Ebook";
            $stmt = Dbh::getInstance()
                -> getDb()
                -> prepare($query);

                $stmt -> execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * RETRIEVE
         */
        public function createAccessoEbook($Ebook,$Utilizzatore){
            $dateNow = date('Y-m-d h:i:sa');
            $query="INSERT into accesso_ebook value($Ebook,'$Utilizzatore','$dateNow')";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateNumeroAccessi($codice){


        }


        public function getClassificaEbook(){
            $query ="UPDATE  * FROM Accesso_Ebook";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }


    }
?>