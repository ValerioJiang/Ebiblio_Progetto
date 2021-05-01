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
         * CREATE
         */

         public function createEbook($Titolo, $Edizione, $Genere, $AnnoPubblicazione, $Dimensione){
             //dimensione la calcoliamo dopo aver caricato il file
            $pdfPath = "C:/xampp/htdocs/Ebiblio/pdf_ebook/".$Titolo.".pdf";

            $query ="INSERT INTO Ebook(Titolo, Edizione, Genere, AnnoPubblicazione, PDF, Dimensione) VALUES('$Titolo', '$Edizione','$Genere', $AnnoPubblicazione , '$pdfPath', $Dimensione)";
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

        public function getLikeLibroUtil($Titolo){
            $query="SELECT * FROM Ebook WHERE LOWER(Titolo) LIKE CONCAT"."('%',LOWER('$Titolo'),'%')";
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }


        public function getAccessi($Codice){
            $query="SELECT *  from ebook  WHERE Codice = $Codice";
            
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        public function updateNumeroAccessi($Codice,$NumeroAccessi){
            $query="UPDATE Ebook  set NumAccessi = 1+$NumeroAccessi WHERE Codice = $Codice";
            
            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        
        


    }
