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
        public function createPrestito($Utilizzatore,$codLibro, $nomeBiblio,$dataInizio,$dataFine){
            $dataFine = date("Y-m-d", strtotime("{$dataInizio}+15 days"));
            $query = "INSERT INTO Prestito(Utilizzatore, Libro, Biblioteca, DataInizio, DataFine) VALUES ('$Utilizzatore',$codLibro, '$nomeBiblio','$dataInizio','$dataFine')";

        }
    }
?>