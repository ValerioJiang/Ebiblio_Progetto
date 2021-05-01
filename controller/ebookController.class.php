<?php
    class Ebook{
        public $Codice; 
        public $Titolo; 
        public $Edizione; 
        public $Genere; 
        public $AnnoPubblicazione; 
        public $Dimensione; 
        public $PDF;
        public $NumAccessi;
    }

    class EbookController{
        /**
         * LIST
         */
        public function list(){
            $query ="SELECT * FROM Ebook";
            $stmt = Dbh::getInstance()
                -> getDb()
                -> prepare($query);

                $stmt -> execute();
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * RETRIEVE
         */
        public function getLikeEbook($tit){
            $query="SELECT * FROM Ebook WHERE LOWER(Titolo) LIKE CONCAT"."('%',LOWER('$tit'),'%')";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteEbook($Codice){
            $query="DELETE FROM Ebook WHERE codice = $Codice";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }


    }
?>