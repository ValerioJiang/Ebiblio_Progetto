<?php
    /** Per visualizzare i dati
     * $testObj = new BibliotecaController();
     *   $res = $testObj -> getBiblioteca();
     *   
     *   echo '<pre>', var_dump($res) , '</pre>';
     *   for($i = 0; $i < count($res);$i++){
     *       foreach($res[$i] as $r){
     *           echo ($r);
     *       }
     *       echo '<br>';
     *   }
     */
    include('./model/Biblioteca.php');

    class BibliotecaController{

        /**
         * LIST
         */
        public function list(){
            $res = array();
            $query = "SELECT * FROM Biblioteca";

            $stmt = Dbh::getInstance()
                ->getDb()
                ->prepare($query);
            $stmt-> execute();
    
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * CREATE
         */
        public function create($biblio){
            
        }

    }
?>