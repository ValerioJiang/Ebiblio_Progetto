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
        public function getPostoLettura($NomeBiblio){
            $query="SELECT * FROM POSTO_LETTURA WHERE Biblioteca = '$NomeBiblio'";

            $stmt = Dbh::getInstance()
            -> getDb()
            -> prepare($query);

            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
            
        }
    }
?>