<?php
    class Consegna{
        public $Codice; 
        public $Volontario; 
        public $CodicePrestito; 
        public $DataConsegna; 
        public $TipoConsegna; 
        public $Note;
    }

    class ConsegnaController{

        /**
         * LIST
         */
        public function list(){

        }

        /**
         * CREATE
         */
        public function createConsegna($CodicePrestito,$TipoConsegna){
            $query = "INSERT INTO CONSEGNA(CodicePrestito, TipoConsegna) VALUES('$CodicePrestito','$TipoConsegna')";

        }
    }
?>