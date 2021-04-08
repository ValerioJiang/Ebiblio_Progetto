<?php
    class Prestito{
        public $Codice;
        public $Utilizzatore;
        public $Libro;
        public $Biblioteca;
        public $DataInizio;
        public $DataFine;
    }

    class PrestitoController{
        /**
         * LIST
         */
        public function createPrestito($Utilizzatore,$codLibro, $nomeBiblio, $Scaffale, $dataInizio){
            $dataFine = date("Y-m-d", strtotime("{$dataInizio}+15 days"));
            $query = "INSERT INTO Prestito(Utilizzatore, Libro, Biblioteca, Scaffale, DataInizio, DataFine) VALUES ('$Utilizzatore',$codLibro, '$nomeBiblio','$Scaffale','$dataInizio','$dataFine')";

            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
            echo $query;
            return $bool = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            
        }
    }
?>